@extends('layouts.app')
@section('header','Pages')
@section('description','Manage pages here.')
@section('content')
@include('layouts.partials.success')
@include('layouts.partials.errors')

        <!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Document</h3>

        <div class="pull-right">
          <a href="{{ URL::route('pages.create',$id)}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add Page</a>
        </div>
        <div style="margin-right: 5px;" class="pull-right">
            <a href="{{url()->previous()}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
            </div>
      </div>
          <div class="box-body">
            <table id="tabledocument" class="table table-bordered table-striped">
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
                                 
                                 
                              
                                 <td><a href="{{URL::route('pages.show',[$data->doc_id,$data->id]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-open-file"></span></a> </td>

                                  <td><a href="{{URL::route('pages.edit',[$data->doc_id,$data->id]) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-file"></span></a> </td> 
                                    
                                  <td>
                                {{ Form::open([ 'method'  => 'delete', 'route' => [ 'pages.destroy',$data->doc_id,$data->id ]])}}
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
