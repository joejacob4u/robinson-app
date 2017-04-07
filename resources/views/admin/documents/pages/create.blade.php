@extends('layouts.app')
@section('header','Add Page')
@section('description','')
@section('content')
@include('layouts.partials.success')
@include('layouts.partials.errors')

 <!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="/bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<!-- Main content -->
<section class="content">
 <div class="box box-default">
   
    </ul>
  </div>
  @endif
  {!!Form::open(['route' => ['pages.store',$id]]) !!}
  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
  <input name="id" type="hidden" value="{{$id}}" />
  <div class="box-header with-border">
    <h3 class="box-title">Document Details</h3>

  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="row">
      <div class="col-md-4">
 
        <div class="form-group">
          <label for="1">Page Number</label>
          {!!Form::number('doc_page_no', '', ['class' => 'form-control','placeholder' => 'Page Number'])!!}
        </div> 
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label for="1">Tags</label>
          {!!Form::text('tags', '', ['class' => 'form-control','placeholder' => 'Tags'])!!}
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
                <textarea class="textarea" id="doc_page_content" name="doc_page_content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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