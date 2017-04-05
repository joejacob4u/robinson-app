@extends('layouts.app')
@section('head')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="/bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

@endsection
@section('content')   
<!-- Content Header (Page header) -->
<section class="content-header">
 <h1>
  Edit Page

</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">User</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
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


  {!!Form::model($data,['route' =>['pages.update',$data->id]]) !!}
   {{ method_field('PUT') }} 

  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
  {{-- <input name="id" type="hidden" value="{{$id}}" /> --}}
  <div class="box-header with-border">
    <h3 class="box-title">Document Details</h3>

  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-4">

        <div class="form-group">
          <label for="1">Page Number</label>
          {!!Form::number('doc_page_no',null, ['class' => 'form-control','placeholder' => 'Page Number'])!!}
        </div> 
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="1">Tags</label>
          {!!Form::text('tags',null, ['class' => 'form-control','placeholder' => 'Tags'])!!}
        </div> 
      </div>
      </div>  <!--/row -->
       <div class="row">
      <div class="col-md-12">
      <div class="form-group">
        

        {{-- <div class="box"> --}}
        <div class="box-header">
          <h3 class="box-title">Page Content
           
          </h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            
                
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form>
               {{--  <textarea class="textarea" id="doc_page_content" name="doc_page_content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea> --}}

               {{ Form::textarea('doc_page_content', null, ['class' => 'textarea','id'=>'doc_page_content','name'=>'doc_page_content','style'=>'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;']) }}

              </form>
            </div>
            {{-- </div> --}}


          </div>    
          </div>



        </div><!-- /.col -->


        <div class="col-md-4">
          <div class="form-group">
            <input class="btn btn-success" type="submit" id="submit" />
          </div>
        </div>
      </div><!-- /.box-body -->
    </form>

  </div>

</section><!-- /.content -->

@endsection
@section('script_code')
<!-- Bootstrap WYSIHTML5 -->
<script src="/bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.

    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>
@endsection