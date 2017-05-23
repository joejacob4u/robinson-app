@extends('layouts.app_home')
@section('content')




<!-- Begin page content -->



    <div class="container page-content">



      <div class="row">

      <div class="row">

      <div class="span2" style="margin-left: 450px;">
      <ul class="nav nav-pills">

      <a href="#" onclick="startRecording()" id="start"  class="btn btn-info" role="button">Read <span class="fa fa-microphone"></span></a>

      <a style="display:none" href="#" id="pause" onclick="pauseRecording()"  class="btn btn-info" role="button">Pause <span class="fa fa-pause"></span></a>

      <a style="display:none" href="#" id="resume" onclick="resumeRecording()"  class="btn btn-info" role="button">Resume <span class="fa fa-play"></span></a>

      <a href="#" onclick="stopRecording()" id="stop" class="btn btn-danger" role="button">Stop <span class="fa fa-stop"></span></a>

      <a href="#" onclick="getPrev()" class="btn btn-info" role="button"><span class="fa fa-step-backward"> Previous</span></a>
      <a href="#" onclick="getNext()" id="stop" class="btn btn-danger" role="button">Next <span class="fa fa-step-forward"></span></a>


      {{-- <a href="#" onclick="finishReading()" id="fnish" class="btn btn-danger" role="button">Finsh Reading <span class="fa fa-step-forward"></span></a> --}}

      <input type="hidden" value='1' id='doc_id'>
      <input type="hidden" value='1' id='doc_page_no'>
      <input type="hidden" value='document' id='type'>
      <input type="hidden" value='{{\Auth::user()->id}}' id='user'>


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

          <li class="lipages" id="page_{{$data->id}}">
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
                  <div class="progress" style="display:none;">
                       <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                         Recording
                       </div>
                  </div>

                </li>




          </div>

        </div>
      </div>
    </div>


 <!-- Edit Show -->
    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalAdd">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 align="center" class="modal-title" id="myModalLabel"></h4>
          </div>

    </div>
    </div>
    <!-- End Edit Model -->









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
  $(".progress").show();

  $("#start").hide();
  $("#pause").show();

  var mediaConstraints = {
      audio: true
  };

  navigator.getUserMedia(mediaConstraints, onMediaSuccess, onMediaError);

  function onMediaSuccess(stream) {
      var count = 1;
      mediaRecorder = new MediaStreamRecorder(stream);
      mediaRecorder.mimeType = 'audio/wav';
      mediaRecorder.ondataavailable = function (blob) {
          // POST/PUT "Blob" using FormData/XHR2
          var fileType = 'audio'; // or "audio"
          var fileName = 'audio_'+count+'.wav';  // or "wav" or "ogg"

          var type = document.getElementById("type").value;
          var docId = document.getElementById("doc_id").value;
          var pageNo = document.getElementById("doc_page_no").value;
          var uId = {{\Auth::user()->id}}

          var formData = new FormData();
          formData.append('key','user/'+uId+'/document/'+docId+'/page/'+pageNo+'/'+fileName);
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
  saveUserState('attempted');
  $(".progress").hide();

  $("#pause").hide();
  $("#resume").hide();
  $("#start").show();

  setTimeout(
      function()
      {
        mediaRecorder.stop();
        $('#stop').prop('disabled',false);
      }, 3000);

}



function finishReading()
{
  saveUserState('finished');
  $(".progress").hide();

  $("#pause").hide();
  $("#resume").hide();
  $("#start").show();

  setTimeout(
      function()
      {
        mediaRecorder.stop();
        $('#stop').prop('disabled',false);
      }, 3000);

}




function pauseRecording()
{
  saveUserState('attempted');
  $(".progress").hide();

    $("#pause").hide();
    $("#resume").show();


  setTimeout(
      function()
      {
        mediaRecorder.pause();
        $('#stop').prop('disabled',false);
      }, 3000);

}


function resumeRecording()
{
  saveUserState('attempted');
  $(".progress").show();

    $("#pause").show();
    $("#resume").hide();


  setTimeout(
      function()
      {
        
        mediaRecorder.resume();
        $('#stop').prop('disabled',false);
      }, 3000);

}








function saveUserState(state)
{
  var docId = document.getElementById("doc_id").value;
  var pageNo = document.getElementById("doc_page_no").value;
  var uId = {{\Auth::user()->id}}

  $.ajax({
    type: 'POST',
    url: '{{ asset('read/document/save-state') }}',
    data: { '_token' : '{{ csrf_token() }}', 'document_id': docId, 'user_id': uId, 'page_no': pageNo,'status': state},
    beforeSend:function()
    {
      $('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    },
    success:function(data)
    {
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

function processAudio()
{
    $.ajax({
      type: 'POST',
      url: '{{ asset('read/document/save-state') }}',
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
