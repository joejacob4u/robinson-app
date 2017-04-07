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
        @yield('header')
        <small>@yield('description')</small>
      </h1>
      <ol class="breadcrumb">
         {!! Breadcrumbs::render() !!}
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
     @yield('content')
    </section>
    <!-- /.content -->
  </div>

      <!-- /.row (main row) -->
    <!-- /.content -->
  <!-- /.content-wrapper -->
  @include('layouts.footer')

</div>

</body>
</html>
