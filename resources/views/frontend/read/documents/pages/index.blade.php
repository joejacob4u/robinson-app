@extends('layouts.app_home')
@section('content')

 


<!-- Begin page content -->

 

    <div class="container page-content"> 



      <div class="row">

      <div class="row">

      <div class="span2" style="margin-left: 450px;">
      <ul class="nav nav-pills">
                           
      <a href="#" onclick="startRecording()" class="btn btn-info" role="button">Read <span class="fa fa-microphone"></span></a>
      <a href="#" onclick="stopRecording()" id="stop" class="btn btn-danger" role="button">Stop <span class="fa fa-stop"></span></a>
      <input type="hidden" value='1' id='doc_id'>
      <input type="hidden" value='1' id='doc_page_no'>
                                    
      </ul>    
     </div>
                                
       </div>
       </div> 
       </br>

        <div class="col-md-4 bg-white">

          <div class=" row border-bottom padding-sm" style="height: 40px;overflow-y:auto">
          Pages
          </div> 
          <!-- member list -->
          <ul class="friend-list">
          {{-- <li class="active">
            <a href="#" class="clearfix">
              <img src="img/Friends/guy-1.jpg" alt="" class="img-circle">
              <div class="friend-name"> 
                <strong>Page Number:</strong>
              </div>
              <div class="last-message text-muted">Hello, Are you there?</div>
              <small class="time text-muted">Just now</small> 
              <small class="chat-alert label label-danger">1</small>
            </a>
          </li> --}}
          @foreach($pages as $data)
          
          <li class="lipages">
              <a href="#" onclick="page({{$data->doc_id}},{{$data->id}})" class="clearfix">
              <div class="friend-name"> 
                <strong>Page Number : {{$data->doc_page_no}}</strong>
              </div>
              <div class="last-message text-muted">Tags : {{$data->tags}}</div>
          
         
            </a>
          </li>   

          @endforeach              
          </ul>
        </div>

        <!--=========================================================-->
        <!-- selected chat -->
        <div class="col-md-8 bg-white ">
          <div class="chat-message" style="max-height: 600px;overflow-y:auto ">
            <ul class="chat">

                <li class="right clearfix">

                  <div class="chat-body clearfix">
                    <div class="header">
                      <strong class="primary-font">Page Number</strong>
                      
                    </div>
                    <p id='page'>
                    Page Content here
                    </p>
                  </div>
                </li>




          </div>
           
        </div>        
      </div>
    </div>
  

<script src="https://cdn.webrtc-experiment.com/MediaStreamRecorder.js"> </script>
<script>



 function upload_file(fd) {


 

    return $.ajax({
        type : 'POST',
        url : 'https://reader-raven.s3-us-west-2.amazonaws.com/',
        data : fd,
        processData: false,  // Don't process the data
        contentType: false,  // Don't set contentType
        success: function(json) { console.log('Upload complete!') },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log('Upload error: ' + XMLHttpRequest.responseText);
        }
    });
};





function onMediaError(e) {
    console.error('media error', e);
}
function startRecording()
{
  var mediaConstraints = {
      audio: true   // don't forget audio!
  };

  navigator.getUserMedia(mediaConstraints, onMediaSuccess, onMediaError);

  function onMediaSuccess(stream) {
      var count = 1;
      mediaRecorder = new MediaStreamRecorder(stream);
      mediaRecorder.mimeType = 'audio/wav';
      mediaRecorder.ondataavailable = function (blob) {
          // POST/PUT "Blob" using FormData/XHR2
          var fileType = 'audio'; // or "audio"
          var fileName = 'read_'+count+'.wav';  // or "wav" or "ogg"


          var docId = document.getElementById("doc_id").value;
          var pageNo = document.getElementById("doc_page_no").value;
          var uId = {{\Auth::user()->id}}

          var formData = new FormData();
          formData.append('key','User-'+uId+'/Document-'+docId+'/Page-'+pageNo+'/'+fileName);
          formData.append('acl', 'bucket-owner-full-control');
          formData.append('Content-Type','audio/wav');
          formData.append("file",blob);


      
          upload_file(formData);

          count++;
      



    

      };
      mediaRecorder.start(5 * 1000);
  }
}

function stopRecording()
{
  setTimeout(
      function()
      {
        mediaRecorder.stop();
        $('#stop').prop('disabled',false);
      }, 3000);

}

function processAudio()
{
    $.ajax({
      type: 'POST',
      url: '{{ asset('/process') }}',
      data: { '_token' : '{{ csrf_token() }}', 'passage': $('#passage').val() },
      beforeSend:function()
      {
        $('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success:function(data)
      {
        var json = jQuery.parseJSON(data);
        $('#result').val(json.transcript); 
        $('#result-label').html('Result:'+json.similarity+'%');
      },
      error:function()
      {
        // failed request; give feedback to user
      },
      complete: function(data)
      {
          $('.overlay').remove();
      }
    });
}
</script>




<script>
  


</script>



@endsection


