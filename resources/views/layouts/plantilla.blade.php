@extends('layouts.app')

@section('title', 'Docente')

@section('links')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
@endsection

@section('content-profe')
        <header class="header d-flex flex-md-row bg-white border-bottom">
            <div class="nav border-right">
                @yield('into-back')
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand font-weight-bold" href="#">
                    @yield('contenido-item')
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-dark"> <i class="fas fa-bars"></i></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <div class="mr-4">
                            <a class="text-dark" href="{{ route('main') }}">
                                <i class="fas fa-home fa-w-16 fa-2x"></i>
                            </a>
                        </div>
                        <div class="my-2 my-sm-0">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="mr-sm-2 text-dark">
                                <i class="fas fa-sign-out-alt fa-w-16 fa-2x"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>

                        {{--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
                        {{--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
                    </form>
                </div>
            </nav>

            {{--<nav class="navbar navbar-expand-md navbar-dark bg-white">--}}
                {{--<div class="container-fluid">--}}
                    {{--<div class="navbar-brand">--}}
                        {{--@yield('contenido-item')--}}
                    {{--</div>--}}
                    {{--<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">--}}
                        {{--<span class="text-dark"> <i class="fas fa-bars"></i></span>--}}
                    {{--</button>--}}
                    {{--<div class="collapse navbar-collapse" id="navbarCollapse">--}}
                        {{--<ul class="nav navbar-nav">--}}
                            {{--<li class="nav-item active">--}}
                            {{--Hola Mundo--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        {{--<div class="clearfix form-inline float-right mt-2 mt-md-0 pr-5">--}}
                            {{--<a href="{{ route('logout') }}" onclick="event.preventDefault();--}}
                            {{--document.getElementById('logout-form').submit();" class="text-dark">--}}
                                {{--<i class="fas fa-sign-out-alt fa-w-16 fa-2x"></i>--}}
                            {{--</a>--}}
                            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                {{--{{ csrf_field() }}--}}
                            {{--</form>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</nav>--}}
            <!-- Navegación pulse animated-->
        </header>

        <!-- Inicia contenido de Página -->
        <div class="scroll-user mCustomScrollbar">
            <main role="main" class="container-fluid">
                @yield('contenido')
            </main>
        </div>

        <footer class="footer">
            <div class="container">
                <span class="text-muted">TeachAR - Ciencias Básicas.</span>
            </div>
        </footer>
@endsection

@section('scriptjs')

    <script type="text/javascript">
        (function ($) {
            $(window).on("load", function () {
                $(".scroll-user").mCustomScrollbar({
                    axis:"y"
                });
            })
        })(jQuery);
    </script>

    @yield('scripts')

@endsection