@extends('layouts.app_home')
@section('content')





  <div class="container page-content">
      <div class="row">
        <div class="col">
          <div class="widget">
            <div class="table-responsive">
            <a href="#" class="table-link danger" data-toggle="modal" data-target="#modalAdd">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                      </span>
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
                    <a href="#" class="table-link success">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                    <a href="#" onclick="edit({{$data->id}})" class="table-link" data-toggle="modal" data-target="#modalEdit">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                    <a href="#" class="table-link danger" data-toggle="modal" data-target="#modalShow">
                      <span class="fa-stack">
                        <i class="fa fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                      </span>
                    </a>
                  </td>
                </tr>

                <!-- Modal -->
    <div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure want to delete</h4>
          </div>
          <div class="modal-body text-centers">
          {{ Form::open([ 'method'  => 'delete', 'route' => [ 'accounts.destroy', $data->id ]])}}
          {{ Form::button('Delete', ['type'=>'submit','class' => 'btn  btn-danger btn-primary btn-xs  ']) }} 
          {{ Form::close() }}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    {{-- <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Are you sure want to Edit</h4>
          </div>
          <div class="modal-body text-centers">
          

                        <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="widget radius-bordered">
                      <div class="widget-header">
                          <span class="widget-caption">Input Groups</span>
                      </div>
                      <div class="widget-body">
                          <div class="collapse in">
                              
                                  <h5>With Icon</h5>
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
                                          <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock maroon"></i></span>
                                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                  <div class="form-group">
                                  <input class="btn btn-success" type="submit" id="submit" />
                                  </div>
                                  </div>

                                  {!! Form::close() !!}
                                 


                            
                          </div>
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
    </div> --}}

  
                 @endforeach


      <!-- Edit Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalAdd">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New Student</h4>
          </div>
          <div class="modal-body text-centers">
          
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="widget radius-bordered">
                      <div class="widget-header">
                          <span class="widget-caption">Input Groups</span>
                      </div>
                      <div class="widget-body">
                          <div class="collapse in">
                              
                                  <h5>With Icon</h5>
                                   {!!Form::open( ['route' => 'accounts.store','files' => true]) !!}
                                  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                  <input name="edit_id" type="hidden" value="" />

                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-user darkorange"></i></span>
                                          <input type="text"  name="name" class="form-control" placeholder="Username" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                          <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock maroon"></i></span>
                                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                  <div class="form-group">
                                  <input class="btn btn-success" type="submit" id="submit" />
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
    <!-- End Edit Model -->

                
              </tbody>
            </table>
            </div>
            <ul class="pagination pull-right">
            <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
            </ul>
            </div>
        </div>
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalAdd">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add New Student</h4>
          </div>
          <div class="modal-body text-centers">
          
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="widget radius-bordered">
                      <div class="widget-header">
                          <span class="widget-caption">Input Groups</span>
                      </div>
                      <div class="widget-body">
                          <div class="collapse in">
                              
                                  <h5>With Icon</h5>
                                   {!!Form::open( ['route' => 'accounts.store','files' => true]) !!}
                                  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-user darkorange"></i></span>
                                          <input type="text" name="name" class="form-control" placeholder="Username" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                          <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock maroon"></i></span>
                                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                  <div class="form-group">
                                  <input class="btn btn-success" type="submit" id="submit" />
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



<script>

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
         function edit(id){
          var id=id;
            $.ajax({
               type:'GET',
               url:'/accounts/'+id+'/edit',
               success:function(data){
                  //$("#edit_name").val(data.name);
                  //document.getElementById('edit_name').value="adsfsf";
                 
                  
                  $('#edit_id').val("asdfadsfasd");


               }
            });
         }
      </script>

@endsection


5 11 2014
2013 