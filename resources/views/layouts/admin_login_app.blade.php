<!DOCTYPE html>
<html>
<!-- Head -->
@include('layouts.head')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Header -->
  <header class="main-header">
  <!-- Logo -->
  <a href="/admin" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Reader</b>Raven</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

      </ul>
    </div>
  </nav>
</header>

  <!-- end Header -->

 


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
