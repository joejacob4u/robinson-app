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
use App\Classes\FFMpeg;
use App\Classes\Speech;

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

        $document_page = UserDocumentRead::where('processed',0)->where('status','attempted')->orderBy('id','desc')->first();
        $document_page_content = DocumentPages::where('doc_id',$document_page->document_id)->where('doc_page_no',$document_page->page_no)->first();
        $files = Storage::disk('s3')->files('user/'.$document_page->user_id.'/document/'.$document_page->document_id.'/page/'.$document_page->page_no);

        if(!count($files) > 1)
        {
          exit;
        }

        $list_path = "lists/list_".$document_page->user_id."_".$document_page->document_id."_".$document_page->page_no.".txt";
        $combined_audio_path = storage_path("app/audio/combined/audio_".$document_page->user_id."_".$document_page->document_id."_".$document_page->page_no.".wav");
        $converted_audio_path = storage_path("app/audio/converted/audio_".$document_page->user_id."_".$document_page->document_id."_".$document_page->page_no.".flac");

        Storage::put($list_path,"");

        foreach($files as $file)
        {
            file_put_contents(storage_path("app/".$list_path), "file ".Storage::disk('s3')->url($file). "\n", FILE_APPEND);
        }

        $ffmpeg = new FFMpeg;

        if($ffmpeg->combine($list_path,$combined_audio_path))
        {
           if($ffmpeg->convert($combined_audio_path,$converted_audio_path))
           {
               $speech = new Speech;

               $transcription = $speech->transcribe($converted_audio_path);

               if($transcription != 'error')
               {
                  $accuracy = $speech->similarity($transcription,$document_page_content->doc_page_content);
                  $processed = 1;
                  $status = ($accuracy > 60) ? 'read' : 'fail';
               }
               else
               {
                 $accuracy = 0;
                 $status = 'error';
                 $transcription = '';
                 $processed = 0;
               }

               File::delete($list_path, $combined_audio_path, $converted_audio_path);

               UserDocumentRead::where('id',$document_page->id)->update(['processed' => $processed,'transcription' => $transcription,'accuracy' => $accuracy,'status' => $status]);
           }
        }
    }

    public function getResults(Request $request)
    {
        $result = UserDocumentRead::find($request->id);
        return $result;
    }
}
