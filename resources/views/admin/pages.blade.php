@extends('layouts.app')
 @section('content')   
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1>
            Pages
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            
                <p class="navbar-btn">
                    <a href="/admin/pages/add/{{$id}}" class="btn btn-default">Add New Page</a>
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

          
          <table id="tablepages" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sl.no</th>
                        <th>Page Number</th>
                        <th>Tags</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $sl=1; ?>
                        @foreach($data as $data)
                            <tr>
                              <td>{{$sl++}}</td>
                              <td>{{$data->doc_page_no}}</td>
                              <td>{{$data->tags}}</td>
                             <td><input type="button" onclick="window.location.href='{{ URL::route('pages.show',$data->id) }}'" id="position_delete" name="position_delete" class="btn btn-primary" value="View" /></td>
      
                              <td><input type="button" onclick="window.location.href='{{ URL::route('pages.edit',$data->id) }}'" id="position_edit" name="position_edit" class="btn btn-primary" value="Edit" /></td>
                              <td><input type="button" onclick="window.location.href='/admin/pages/delete/{{$data->doc_id}}/{{$data->id}}'" id="position_delete" name="position_delete" class="btn btn-danger" value="Delete" /></td>
                            </tr>

                          @endforeach
                    </tbody>
                  </table>
          
          
       
        
        </section><!-- /.content -->

      @endsection
      @section('script_code')
        <script>
            $(function () {
              $('#tablepages').DataTable({
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