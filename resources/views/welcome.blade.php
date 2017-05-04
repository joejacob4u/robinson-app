
@extends('layouts.app_home')
@section('content')


<style type="text/css">
  #modalselect .modal-dialog .modal-content
  {
    width: 350px;
    margin: auto auto;
  }
</style>
   <!-- Modal Select User -->
    <div class="modal fade" id="modalselect" tabindex="-1" role="dialog" aria-labelledby="myModalAdd" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
            <h4 class="modal-title" id="myModalLabel">Select User Type</h4>
          </div>
          <div class="modal-body text-centers">
          
            <div class="row">
              <div class="col-md-12" style="text-align: center;">
                  <div class="widget radius-bordered">
                      
                      <div class="widget-body">
                          <div class="collapse in">
                              
                                 
                                   {!!Form::open( ['route' => 'accounts.store','files' => true]) !!}
                                      {{-- <input class="btn btn-success btn-labeled" type="submit" id="btnparent" /> --}}
                                      <a href="/accounts/user-type/0" class="btn btn-labeled btn-darkorange shiny">
                       				 <i class="btn-label glyphicon glyphicon-education"></i>Student
                    					</a>
                    					 <a href="/accounts/user-type/1" class="btn btn-labeled btn-purple shiny">
                       				 <i class="btn-label glyphicon glyphicon-user"></i>Parent
                    					</a>


                                      {{-- <input class="btn btn-success" type="submit" id="btnstudent" /> --}}

                                  {!! Form::close() !!}
                                 


                            
                          </div>
                      </div>
                  </div>
              </div>


          </div>
          {{-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> --}}
        </div>
      </div>
    </div>
    </div>
    {{-- End Model Select User --}}



 

@endsection
@section('script_code')
<script type="text/javascript">

  if("{{\Auth::user()->type}}"=='User')
  $('#modalselect').modal('toggle');
 
</script>

@endsection
