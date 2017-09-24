<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','AJAX Todo App | Login')</title>


    <!-- Google font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{ asset('css/custom.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]-->
    <script src="{{ asset('js/html5shiv.min.js')}}"></script>
    <script src="{{ asset('js/respond.min.js')}}"></script>

</head>
<body>
<div id="app">
    <!-- Navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><strong>Todo</strong>App</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if(! Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="glyphicon glyphicon-user"></i>
                            Edomaru <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </li>
                        @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    @yield('content')
</div>

<!-- Scripts -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->


<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('icheck/icheck.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/app.js')}}"></script>

</body>
</html>
