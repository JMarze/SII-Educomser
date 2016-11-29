<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>

	<!-- core CSS -->
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/font-awesome.min.css') !!}
    {!! Html::style('css/animate.min.css') !!}
    {!! Html::style('css/prettyPhoto.css') !!}
    {!! Html::style('css/main.css') !!}
    {!! Html::style('css/responsive.css') !!}
    <!--[if lt IE 9]>
    {!! Html::script('js/html5shiv.js') !!}
    {!! Html::script('js/respond.min.js') !!}
    <![endif]-->
    <link rel="shortcut icon" href="{!! asset('images/ico/favicon.ico') !!}"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{!! asset('images/ico/apple-touch-icon-144-precomposed.png') !!}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{!! asset('images/ico/apple-touch-icon-114-precomposed.png') !!}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{!! asset('images/ico/apple-touch-icon-72-precomposed.png') !!}">
    <link rel="apple-touch-icon-precomposed" href="{!! asset('images/ico/apple-touch-icon-57-precomposed.png') !!}">

    @yield('style')

</head><!--/head-->

<body class="homepage">

    <!-- Facebook -->
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number">
                            <p>
                                <i class="fa fa-btn fa-phone-square"></i>&nbsp;&nbsp;&nbsp;(591) 2318134
                                &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-btn fa-envelope-o"></i>&nbsp;&nbsp;&nbsp;<a href="mailto:cursos@educomser.com">cursos@educomser.com</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}" title="Educación en Computación y Servicios">
                        <i class="fa fa-btn fa-laptop"></i>&nbsp;Educomser SRL
                    </a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        @include('layouts.partial.menu')
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->

    </header><!--/header-->

    @yield('content')

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; {{ Carbon\Carbon::now()->year }} Educomser SRL. Todos los derechos reservados.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        @include('layouts.partial.menu')
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    {!! Html::script('js/jquery.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('js/jquery.prettyPhoto.js') !!}
    {!! Html::script('js/jquery.isotope.min.js') !!}
    {!! Html::script('js/main.js') !!}
    {!! Html::script('js/wow.min.js') !!}

    @yield('script')
</body>

</html>
