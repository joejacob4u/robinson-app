<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Google\Cloud\Storage\StorageClient;
use Google\Cloud\Speech\SpeechClient;
use File;

class AudioController extends Controller
{
    public function save(Request $request)
    {
        foreach(array('video', 'audio') as $type)
        {
          if (isset($_FILES["${type}-blob"]))
           {
              $fileName = $_POST["${type}-filename"];
              $uploadDirectory = "audio-uploads/$fileName";

              if (!move_uploaded_file($_FILES["${type}-blob"]["tmp_name"], $uploadDirectory)) {
                  echo("problem moving uploaded file");
              }
              else{
                file_put_contents("list.txt", "file audio-uploads/".$fileName. "\n", FILE_APPEND);
              }

              echo($uploadDirectory);
          }
      }
    }

    public function processSpeech(Request $request)
    {
      set_time_limit(0);

      $list_path = '/var/www/public/robinson-app/public/list.txt';
      $combined_audio_path = '/var/www/public/robinson-app/public/master.wav';
      $converted_audio_path = '/var/www/public/robinson-app/public/master3.flac';

      exec('ffmpeg -f concat  -i '.$list_path.' -c copy '.$combined_audio_path);
      exec('ffmpeg -i '.$combined_audio_path.' -af aformat=s16:44100 -ac 1 '.$converted_audio_path);

      // $storage = new StorageClient([
      //               'projectId' => 'potent-density-162402',
      //               'keyFile' => json_decode(file_get_contents(storage_path('app/creds/google-cloud.json')), true)
      //             ]);
      //
      // $bucket = $storage->bucket('robinson-app');
      // $acl = $bucket->acl('allUsers', 'READER');
      //
      //       // Upload a file to the bucket.
      // $data = $bucket->upload(fopen($converted_audio_path, 'r'));

      $speech = new SpeechClient([
          'projectId' => 'potent-density-162402',
          'keyFile' => json_decode(file_get_contents(storage_path('app/creds/google-speech.json')), true)
      ]);

      $options = [
            'encoding' => 'FLAC',
            'sampleRate' => 44100,
            'languageCode' => 'en-US'
      ];

      $results = $speech->recognize(fopen($converted_audio_path, 'r'), $options);
      //echo 'Transcription: ' . $results[0]['transcript'];


      File::cleanDirectory(public_path('audio-uploads'));
      File::delete($list_path, $combined_audio_path, $converted_audio_path);

      $passage_words = str_word_count($request->passage, 1);
      $read_words = str_word_count($results[0]['transcript'], 1);
      $matches = array_intersect($passage_words,$read_words);
      $similarity = round(count($matches)/(count($passage_words))*100);

      $data_result = ['transcript' => $results[0]['transcript'], 'similarity' => $similarity];

      return json_encode($data_result);


    }
}
