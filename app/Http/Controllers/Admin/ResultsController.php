<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\UserDocumentRead;
use App\DocumentPages;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Speech\SpeechClient;
use File;

class ResultsController extends Controller
{
    public function index()
    {
        $user_document_reads = UserDocumentRead::get();
        return view('admin.result.index',['user_document_reads' => $user_document_reads]);
    }

    public function documentCron()
    {
      set_time_limit(0);
      $document_page = UserDocumentRead::where('processed',0)->orderBy('id','desc')->first();
      $document_page_content = DocumentPages::where('doc_id',$document_page->document_id)->where('doc_page_no',$document_page->page_no)->first();
      $files = Storage::disk('s3')->files('user/'.$document_page->user_id.'/document/'.$document_page->document_id.'/page/'.$document_page->page_no);

      if(!count($files) > 1)
      {
        exit;
      }

      $list_path = "lists/list_".$document_page->user_id."_".$document_page->document_id."_".$document_page->page_no.".txt";
      $combined_audio_path = storage_path("app/audio/combined/audio_".$document_page->user_id."_".$document_page->document_id."_".$document_page->page_no.".wav");
      $converted_audio_path = storage_path("app/audio/converted/audio_".$document_page->user_id."_".$document_page->document_id."_".$document_page->page_no.".flac");

      if(!Storage::exists($list_path))
      {
          Storage::put($list_path,"");
      }

      foreach($files as $file)
      {
          file_put_contents(storage_path("app/".$list_path), "file ".Storage::disk('s3')->url($file). "\n", FILE_APPEND);
      }
      //echo 'ffmpeg -f concat -safe "0" -protocol_whitelist "file,http,https,tcp,tls" -i '.storage_path("app/".$list_path).' -c copy '.$combined_audio_path;exit;
      exec('ffmpeg -f concat -safe "0" -protocol_whitelist "file,http,https,tcp,tls" -i '.storage_path("app/".$list_path).' -c copy '.$combined_audio_path);
      exec('ffmpeg -i '.$combined_audio_path.' -af aformat=s16:44100 -ac 1 '.$converted_audio_path);

      $speech = new SpeechClient([
          'projectId' => 'potent-density-162402',
          'keyFile' => json_decode(file_get_contents('https://reader-raven.s3.amazonaws.com/key/google-speech.json'), true)
      ]);

      $options = [
            'encoding' => 'FLAC',
            'sampleRate' => 44100,
            'languageCode' => 'en-US'
      ];

      $results = $speech->recognize(fopen($converted_audio_path, 'r'), $options);

      $passage_words = str_word_count($document_page_content->doc_page_content, 1);
      $read_words = str_word_count($results[0]['transcript'], 1);
      $matches = array_intersect($passage_words,$read_words);
      $similarity = round(count($matches)/(count($passage_words))*100);

      $data_result = ['transcript' => $results[0]['transcript'], 'similarity' => $similarity];

      File::delete($list_path, $combined_audio_path, $converted_audio_path);

      UserDocumentRead::where('id',$document_page->id)->update(['processed' => 1,'transcribed_text' => $results[0]['transcript'],'accuracy' => $similarity]);

    }

    public function getResults(Request $request)
    {
        $result = UserDocumentRead::find($request->id);
        return $result;
    }
}
