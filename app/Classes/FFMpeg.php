<?php

namespace App\Classes;
use App;

class FFMpeg
{
  public function combine($list,$file_name)
  {
    $params = (App::environment('local')) ? '-protocol_whitelist "file,http,https,tcp,tls"' : '';
    exec('ffmpeg -f concat -safe "0" '.$params.' -i '.storage_path("app/".$list).' -c copy '.$file_name);

    if(filesize($file_name))
    {
        return true;
    }
  }

  public function convert($combined_path,$converted_path)
  {
    exec('ffmpeg -i '.$combined_path.' -af aformat=s16:44100 -ac 1 '.$converted_path);

    if(filesize($converted_path))
    {
        return true;
    }

  }
}

 ?>
