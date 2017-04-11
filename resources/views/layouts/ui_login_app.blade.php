
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png">
    <title>ReaderSpeakTrack</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset ("/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset ("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css") }}">
    <link href="{{ asset ("/assets/css/animate.min.css")}}" rel="stylesheet">
    <link href="{{ asset ("/assets/css/timeline.css")}}" rel="stylesheet">
    <link href="{{ asset ("/assets/css/login_register.css")}}" rel="stylesheet">
    <link href="{{ asset ("/assets/css/forms.css") }}" rel="stylesheet">
    <link href="{{ asset ("/assets/css/buttons.css")}}" rel="stylesheet">
    <script src="{{ asset ("/bower_components/jquery/dist/jquery.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset ("/bower_components/bootstrap/dist/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script src="assets/js/custom.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button id="menu-toggle" type="button" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar bar1"></span>
            <span class="icon-bar bar2"></span>
            <span class="icon-bar bar3"></span>
          </button>
          <a class="navbar-brand" href="profile.html">ReaderSpeakTrack</a>
        </div>
      </div>
    </nav>
    <div class="wrapper">
     @yield('content')

      <footer class="footer">
        <div class="container">
          <p class="text-muted"> Copyright &copy; Company - All rights reserved </p>
        </div>
      </footer>
    </div>
  </body>
</html>
