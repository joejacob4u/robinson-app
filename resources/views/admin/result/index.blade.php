@extends('layouts.app')
@section('header','Results')
@section('description','Analyze results here.')
@section('content')
@include('layouts.partials.success')
@include('layouts.partials.errors')

        <!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Results by Page</h3>
      </div>
          <div class="box-body">
            <table id="tabledocument" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Document</th>
                          <th>Page</th>
                          <th>Result</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($user_document_reads as $user_document_read)
                              <tr>
                                <td>{{$user_document_read->user->name}}</td>
                                <td>{{$user_document_read->document->doc_name}}</td>
                                <td>{{$user_document_read->page_no}}</td>
                                <td>{!! link_to('#','Result',['class' => 'btn-xs btn-warning','onclick' => 'getResults("'.$user_document_read->id.'")']) !!}</td>
                              </tr>
                            @endforeach
                      </tbody>
                    </table>
              </div>
        </div>
  </div>

  <!-- Start Modal-->
  <div id="resultModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Page Results</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="comment">Transcribed Text:</label>
            <textarea class="form-control" rows="8" id="transcription" disabled></textarea>
          </div>
          <div class="form-group">
            <label for="accuracy">Accuracy:</label>
            <input type="text" class="form-control" id="accuracy" disabled>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!-- End Modal-->
            @endsection
       @section('script_code')
        <script>
            $(function () {
              $('#tabledocument').DataTable({
              });
            });

            function getResults(id)
            {
              $.ajax({
                type: 'POST',
                url: '{{ url('admin/results/get_result') }}',
                data: { '_token' : '{{ csrf_token() }}', 'id': id },
                beforeSend:function()
                {
                  $('.box').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
                },
                success:function(data)
                {
                  $('#resultModal #transcription').val(data.transcribed_text);
                  $('#resultModal #accuracy').val(data.accuracy);
                  $('#resultModal').modal('show');
                },
                complete:function()
                {
                   $('.overlay').remove();
                },
                error:function()
                {
                  // failed request; give feedback to user
                }
              });
            }

        </script>
      @endsection
