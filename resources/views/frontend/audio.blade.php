 @extends('layouts.app2')

@section('content')
<div class="container">
  <div class="box">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <div class="row">
                    <div class="form-group">
                      <label for="comment">Passage:</label>
                      <textarea class="form-control" rows="5" id="passage"></textarea>
                    </div> 
                  </div>
                  <div class="row">
                    <button onclick="startRecording()" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-record"></span> Record Audio</button>
                    <button onclick="stopRecording()" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-stop"></span> Stop</button>
                    <button id="process-btn" onclick="processAudio()" class="btn btn-warning btn-lg" disabled><span class="glyphicon glyphicon-retweet"></span> Process Audio</button>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <label for="comment">Result:</label>
                      <textarea class="form-control" rows="5" id="result"></textarea>
                    </div>
                    <div class="form-group">
                      <h2><span id="result-label" class="label label-primary">Result:</span></h2>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="https://cdn.webrtc-experiment.com/MediaStreamRecorder.js"> </script>
<script>


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
          var fileName = 'test_'+count+'.wav';  // or "wav" or "ogg"

          var formData = new FormData();
          formData.append(fileType + '-filename', fileName);
          formData.append(fileType + '-blob', blob);
          formData.append('_token', '{{ csrf_token() }}');


          xhr('/record', formData, function (fileURL) {
              window.open(fileURL);
              count++;
          });

          function xhr(url, data, callback) {
              var request = new XMLHttpRequest();
              request.onreadystatechange = function () {
                  if (request.readyState == 4 && request.status == 200) {
                      callback(location.href + request.responseText);
                  }
              };
              request.open('POST', url);
              request.send(data);
          }
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
        $('#process-btn').prop('disabled',false);
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
@endsection
 