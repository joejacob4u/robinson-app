@extends('layouts.app')
@section('header','Documents')
@section('description','Manage documents here.')
@section('content')
@include('layouts.partials.success')
@include('layouts.partials.errors')

        <!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Documents</h3>

        <div class="box-tools pull-right">
          <a href="{{url('admin/documents/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add Document</a>
        </div>
      </div>
          <div class="box-body">
            <table id="tabledocument" class="table table-bordered table-striped">
                      <thead> 
                        <tr>
                          <th>Sl.no</th>
                          <th>Name</th>
                          <th>Author</th>
                          <th>Category</th>
                          <th>Pages</th>
                          <th>Publish Date</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $sl=1; ?>
                          @foreach($data as $data)
                              <tr>
                                <td>{{$sl++}}</td>
                                <td>{{$data->doc_name}}</td>
                                <td>{{$data->doc_author}}</td>
                                <td>{{$data->category->cat_name}}</td> 

                                <td><a href="{{URL::route('pages.index',$data->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-file"></span></a> </td> 
                               
                                <td>{{$data->publish_date}}</td>
                                <td><a href="{{URL::route('documents.edit',$data->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a> </td>

                                <td>
                                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'documents.destroy', $data->id ]])}}
                                {{ Form::button(' <span class="glyphicon glyphicon-remove"></span>', ['type'=>'submit','class' => 'btn  btn-danger btn-primary btn-xs  ']) }} 
                                {{ Form::close() }}
                                </td>


                              </tr>

                            @endforeach
                      </tbody>
                    </table>
              </div>
        </div>
  </div>
            @endsection
       @section('script_code')
        <script>
            $(function () {
              $('#tabledocument').DataTable({
              });
            });
</script>
      @endsection
