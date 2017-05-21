<?php

namespace App\Classes;

use Google\Cloud\Speech\SpeechClient;
use Config;

class Speech
{
  function transcribe($file)
  {
    $speech = new SpeechClient([
        'projectId' => config('google-speech.project_id'),
        'keyFile' => json_decode(file_get_contents(config('google-speech.key')), true)
    ]);

    $options = [
          'encoding' => 'FLAC',
          'sampleRate' => 44100,
          'languageCode' => 'en-US'
    ];

    $results = $speech->recognize(fopen($file, 'r'), $options);

    if(isset($results[0]['transcript']))
    {
      return $results[0]['transcript'];
    }
    else
    {
      return 'error';
    }
  }

  function similarity($transcribed,$passage)
  {
      $passage_words = str_word_count($passage, 1);
      $read_words = str_word_count($transcribed, 1);
      $matches = array_intersect($passage_words,$read_words);
      return round(count($matches)/(count($passage_words))*100);
  }
}


?>
