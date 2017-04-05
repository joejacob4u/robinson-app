@extends('layouts.ui_app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Login</div> -->
                <div class="panel-body">
                     <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
              <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="{{'/'}}">return to dashboard</a> or try using the search form.
              </p>
              <form class="search-form">
                <div class="input-group">
                  
                  
                </div><!-- /.input-group -->
              </form>
            </div><!-- /.error-content -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
