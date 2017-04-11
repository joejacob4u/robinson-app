@extends('layouts.app')
@section('header','Page View')
@section('description','')
@section('content')
@include('layouts.partials.success')
@include('layouts.partials.errors')

        <!-- Main content -->
<!-- Main content -->
        <section class="content">

            
               
      <div class="row" style="margin-top: 10px;">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"></i>Document:{{$data->document->doc_name}}<br>Page Number:{{$data->doc_page_no}}</h3>
              <div style="margin-right: 5px;" class="pull-right">
            <a href="{{url()->previous()}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
            </div>
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