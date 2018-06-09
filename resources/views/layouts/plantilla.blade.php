@extends('layouts.app')

@section('title', 'Docente')

@section('links')
    {{--<meta name="apple-mobile-web-app-capable" content="yes">--}}
    {{--<script src="https://aframe.io/releases/0.8.2/aframe.min.js"></script>--}}
    {{--<script src="https://aframe.io/releases/0.8.0/aframe.min.js"></script>--}}
    <link rel="stylesheet" href="{{asset('css/user.css')}}">

@endsection

@section('content-profe')
        <header class="header d-flex flex-md-row bg-white border-bottom">
            <div class="nav border-right bg-white">
                @yield('into-back')
            </div>
            <nav class="navbar navbar-expand-sm navbar-dark">
                <a class="navbar-brand mr-auto mr-lg-0" href="#"> </a>
                <button class="navbar-toggler" type="button" data-toggle="offcanvas">
                    <span class="text-white"> <i class="fas fa-bars"></i></span>
                    {{--<span class="navbar-toggler-icon"></span>--}}
                </button>

                <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                    <span class="mt-1 d-none" data-toggle="offcanvas" data-target=".navbar-collapse">
                        <i class="fas fa-times-circle text-white fa-1x"></i>
                    </span>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('index') }}">
                                @yield('contenido-item')
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    </ul>
                    <div class="form-inline my-lg-0">
                        <div class="mr-4 mr-md-4 mr-lg-4">
                            <a id="home" class="text-white" href="{{ route('main') }}">
                                <i class="fas fa-home fa-w-16 fa-2x"></i>
                            </a>
                        </div>
                        <div class="my-md-2 my-lg-2 my-sm-0 text-center">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="text-white" data-toggle="tooltip" data-placement="bottom" title="Cerrar Sesión">
                                <i class="fas fa-sign-out-alt fa-w-16 fa-2x"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            {{--<nav class="navbar navbar-expand-lg navbar-light">--}}
                {{--<a class="navbar-brand font-weight-bold text-white" href="{{route('index')}}">--}}
                    {{--@yield('contenido-item')--}}
                {{--</a>--}}
                {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
                    {{--<span class="text-white"> <i class="fas fa-bars"></i></span>--}}
                {{--</button>--}}

                {{--<div class="collapse navbar-collapse" id="navbarCollapse">--}}
                    {{--<ul class="navbar-nav mr-auto">--}}
                        {{--<li class="nav-item active">--}}
                            {{--<a class="nav-link disabled d-none" href="#">Disabled</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<div class="form-inline my-2 my-lg-0">--}}
                        {{--<div class="mr-4">--}}
                            {{--<a class="text-white" href="{{ route('main') }}">--}}
                                {{--<i class="fas fa-home fa-w-16 fa-2x"></i>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                        {{--<div class="my-2 my-sm-0">--}}
                            {{--<a href="{{ route('logout') }}" onclick="event.preventDefault();--}}
                                        {{--document.getElementById('logout-form').submit();" class="text-white">--}}
                                {{--<i class="fas fa-sign-out-alt fa-w-16 fa-2x"></i>--}}
                            {{--</a>--}}
                            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                                {{--{{ csrf_field() }}--}}
                            {{--</form>--}}
                        {{--</div>--}}

                        {{--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">--}}
                        {{--<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</nav>--}}

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

        $(function () {
            'use strict';
            $('[data-toggle="offcanvas"]').on('click', function () {
                $('.offcanvas-collapse').toggleClass('open')
            });

            $('.navbar-collapse span').click(function () {
                $('.navbar-collapse').collapse('hide')
            })
        });
    </script>

    @yield('scripts')

@endsection