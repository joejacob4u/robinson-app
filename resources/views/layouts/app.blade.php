<!DOCTYPE html>
<html>
<!-- Head -->
@include('layouts.head')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Header -->
  @include('layouts.header')

  @include('layouts.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$page_title or ''}}
        <small>{{$page_description or ''}}</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    @if(Session::has('flash_message'))
                        <div class="alert alert-success alert-dismissible techpopupalert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4>    <i class="icon fa fa-check"></i> Alert!</h4>
                                {{Session::get('flash_message')}}
                        </div>
                    @elseif(Session::has('flash_error_message'))
                        <div class="alert alert-danger alert-dismissible techpopupalert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                {{Session::get('flash_error_message')}}
                        </div>
                    @endif
      @yield('content')
    </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
    <!-- /.content -->
  <!-- /.content-wrapper -->
  @include('layouts.footer')

</div>

</body>
</html>
