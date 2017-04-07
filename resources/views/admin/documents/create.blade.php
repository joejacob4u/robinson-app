@extends('layouts.app')
@section('header','Add Document')
@section('description','')
@section('content')
@include('layouts.partials.success')
@include('layouts.partials.errors')

        <!-- Main content -->
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

          
           {!!Form::open( ['route' => 'documents.store','files' => true]) !!}
          
            <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
            
            <div class="box-header with-border">
              <h3 class="box-title">Document Details</h3>
              
            </div><!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                    
                  <div class="form-group">
                      <label for="1">Name</label>
                    {!!Form::text('doc_name', '', ['class' => 'form-control','placeholder' => 'Name'])!!}
                  </div> 
                  <div class="form-group">
                      <label for="1">Publish Date</label>
                      <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  {!!Form::text('publish_date', '', ['id'=>'publish_date','class' => 'form-control pull-right','placeholder' => 'Publish Date'])!!}
                    </div>
                  </div>    
                
                    
                  
                </div><!-- /.col -->
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="1">Author</label>
                    {!!Form::text('doc_author', '', ['class' => 'form-control','placeholder' => 'Author'])!!}
                  </div> 

                  <div class="form-group">
                      <label for="1">Cover Image</label>
                    {!!Form::file('doc_cover', '', ['class' => 'form-control','placeholder' => 'Publish Date'])!!}
                  </div> 
                 
                    
                               
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="1">Category</label>

                  
                    {!!Form::select('category',$categories,'',['class' => 'form-control'])!!}
                  </div> 
                 
                  </div>
                </div><!-- /.col -->
                 <div class="col-md-4">
                  <div class="form-group">
                    <input class="btn btn-success" type="submit" id="submit" />
                  </div>
              </div>
              </div><!-- /.row -->
              
            </div><!-- /.box-body -->
          </form>
          
          </div>
        
        </section><!-- /.content -->

      @endsection
      @section('script_code')
        <script>
            //Date picker
            $('#publish_date').datepicker({
              dateFormat: 'yyyy-mm-dd', 
              autoclose: true,
            });
            
        </script>
      @endsection