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
        <h3 class="box-title">Document</h3>

        <div class="box-tools pull-right">
          <a href="{{url('admin/document/create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add Document</a>
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
                               <td><input type="button" onclick="window.location.href='pages/list/{{$data->id}}'" id="position_delete" name="position_delete" class="btn btn-primary" value="Pages" /></td>
                                <td>{{$data->publish_date}}</td>

                                <td><input type="button" onclick="window.location.href='{{ URL::route('document.edit',$data->id) }}'" id="position_edit" name="position_edit" class="btn btn-primary" value="Edit" /></td>
                                <td><input type="button" onclick="window.location.href='document/delete/{{$data->id}}'" id="position_delete" name="position_delete" class="btn btn-danger" value="Delete" /></td>
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
