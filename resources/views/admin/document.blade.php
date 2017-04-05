@extends('layouts.app')
 @section('content')   
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1>
            Documents
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User</li>
          </ol>
        </section>


        

        <!-- Main content -->
        <section class="content">
        <p class="navbar-btn">
                    <a href="/admin/document/create" class="btn btn-default">Add New Document</a>
                </p>
         <div class="box box-default">
         @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

          
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
          
          
       
        
        </section><!-- /.content -->

      @endsection
       @section('script_code')
        <script>
            $(function () {
              $('#tabledocument').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
              });
            });
</script>
      @endsection