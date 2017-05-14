<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WRTCController extends Controller
{
    public function save(Request $request)
    {


        foreach(array('audio') as $type)
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




}
