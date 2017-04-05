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

            
               
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"></i>Page Number {{$data->doc_page_no}}</h3>
            </div>
            <div class="box-body">
                  <pre style="font-weight: 600;">


{!!$data->doc_page_content!!}

                  </pre>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
          
          
       
        
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