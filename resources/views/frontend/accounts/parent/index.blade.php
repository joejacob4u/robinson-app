@extends('layouts.app_home')
@section('content')





  <div class="container page-content">
      <div class="row">
        <div class="col">
          <div class="widget">
            <div class="table-responsive">
            <a href="#" class="btn btn-primary" style="padding-bottom: 1px;" data-toggle="modal" data-target="#modalAdd">
                      <span class="fa-stack">
                       
                        <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                      </span> Add Student
                    </a>
            <table class="table user-list">
              <thead>
                <tr>
                  <th><span>User</span></th>
                  <th><span>Created</span></th>
                 
                  <th><span>Email</span></th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>

                 @foreach($students as $data) 



                <tr>
                  <td>
                   
                    {{$data->name}}
                    
                  </td>
                  <td>
                    {{$data->created_at}}
                  </td>
                  
                  <td>
                    {{$data->email}}
                  </td>
                  <td style="width: 20%;">
                    <a href="#" onclick="showuser({{$data->id}})" class="table-link success">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                    <a href="#" onclick="edituser({{$data->id}})" class="table-link" >
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                    <a href="#" class="table-link danger" onclick="deluser({{$data->id}})" >
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                  </td>
                </tr>


                 @endforeach

                
              </tbody>
            </table>
            </div>

            <ul class="pagination pull-right">
            
            {{ $students->links() }}
            
           
            </ul>
            </div>
        </div>
      </div>
    </div>

    <style type="text/css">
  #modalEdit .modal-dialog .modal-content
  {
    width: 350px;
    margin: auto auto;
  }
</style>

    <!-- Edit Modal -->
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalAdd">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Student</h4>
          </div>
          <div class="modal-body text-centers">
          
            <div class="row">
              <div class="col-md-12">
                  <div class="widget radius-bordered">
                    
                      <div class="widget-body">
                          <div class="collapse in">
                                  
                                   {!!Form::model($data,['route' =>['accounts.update',0],'files' =>true])!!}
                                   {{ method_field('PUT') }} 
                                  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                  <input name="edit_id" id="edit_id" type="hidden" value="123" />

                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-user darkorange"></i></span>
                                          <input type="text" id="edit_name" name="name" class="form-control" placeholder="Username" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                          <input type="email" id="edit_email" name="email" class="form-control" placeholder="Email Address" required>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock maroon"></i></span>
                                          <input type="password" id="edit_password" name="password" class="form-control" placeholder="Password">
                                      </div>
                                  </div>

                                  <div class="col-md-12" style="text-align: center;">
                                  <div class="form-group">
                                  <input class="btn btn-primary" type="submit" id="submit" />
                                  </div>
                                  </div>

                                 {{ Form::close() }}
          
                            
                          </div>
                      </div>
                  </div>
              </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- End Edit Model -->

    <!-- Edit Show -->
    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalAdd">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Student</h4>
          </div>
          <div class="modal-body text-centers">
          
            <div class="row">
              <div class="col-md-12">
                  <div class="widget radius-bordered">
                      
                      <div class="widget-body">
                          <div class="collapse in">
                              
                                  
                    <div class="col-md-12">
                  <div class="profile-user-details">
                    <div  class="profile-user-details-label"><b>
                    Name: </b><span id="show_name"></span>
                    </div><br/>
                    <div class="profile-user-details-value">
                    <b>EMail: </b><span id="show_email"></span>
                    </div>
                  </div>
                 </div>
                  
          
                            
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
    <!-- End Edit Model -->


<style type="text/css">
  #modaldelete .modal-dialog .modal-content
  {
    width: 350px;
    margin: auto auto;
  }
</style>



    <!-- Modal Distroy-->
    <div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure want to delete</h4>
          </div>
          <div class="modal-body text-centers" style="text-align: center;">
            {{ Form::open([ 'method'  => 'delete', 'route' => [ 'accounts.destroy',0]])}}
               <input name="delete_id" id="delete_id" type="hidden" value="" />
                <input type="submit" style="padding-right: 20px;padding-left: 20px;"  class="btn btn-danger" name="" value="Yes">
                 <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
            {{ Form::close() }}
          

          </div>
         {{--  <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> --}}
        </div>
      </div>
    </div>
    {{-- End Model distroy --}}

<style type="text/css">
  #modalAdd .modal-dialog .modal-content
  {
    width: 350px;
    margin: auto auto;
  }
</style>

    <!-- Modal Add -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalAdd">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New Student</h4>
          </div>
          <div class="modal-body text-centers">
          
            <div class="row">
              <div class="col-md-12">
                  <div class="widget radius-bordered">
                    
                      <div class="widget-body">
                          <div class="collapse in">
                              
                               
                                   {!!Form::open( ['route' => 'accounts.store','files' => true]) !!}
                                  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-user darkorange"></i></span>
                                          <input type="text" id="edit_name" name="name" class="form-control" placeholder="Username" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                          <input type="email" id="edit_email" name="email" class="form-control" placeholder="Email Address" required>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock maroon"></i></span>
                                          <input type="password" id="edit_password" name="password" class="form-control" placeholder="Password" required>
                                      </div>
                                  </div>

                                  <div class="col-md-12" style="text-align: center;">
                                  <div class="form-group">
                                  <input class="btn btn-primary" type="submit" id="submit" />
                                  </div>
                                  </div>

                                  {!! Form::close() !!}
                                 


                            
                          </div>
                      </div>
                  </div>
              </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    </div>


  





@endsection


