@extends('layouts.app_home')
@section('content')





  <div class="container page-content">
      <div class="row">
        <div class="col">
          <div class="widget">
            <div class="table-responsive">
          
            <table class="table user-list">
              <thead>
                <tr>
                  <th><span>Student</span></th>
                  <th><span>Books/Documents</span></th>
                  <th><span>Page</span></th>
                  <th><span>Results</span></th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>

                 @foreach($data as $data) 



                <tr>
                  <td>
                   
                    {{$data->user->name}}
                    
                  </td>
                  <td>
                    {{$data->document->doc_name}}
                  </td>
                  
                  <td>
                    {{$data->page_no}}
                  </td>


                   <td>
                    {!! link_to('#','View',['class' => 'btn-xs btn-warning','onclick' => 'getResults("'.$data->id.'")']) !!}
                  </td>

                </tr>


                 @endforeach

                
              </tbody>
            </table>
            </div>

            <ul class="pagination pull-right">
            
      
            </ul>
            </div>
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
                  $('#resultModal #transcription').val(data.transcription);
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


