@extends('layouts.app')


@section('title', 'Admin')

@section('links')
    <link rel="stylesheet" href="{{asset('vendors/js/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    <link href="{{asset('admin/css/dashboard.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/dashboardMediaQuery.css') }}">
    @yield('estilos')
@endsection

@section('admin-content')
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="side-navbar-wrapper">
            <!-- Sidebar Header-->
            <div class="sidenav-header d-flex align-items-center justify-content-center">
                <!-- Información-->
                <div class="sidenav-header-inner text-center">
                    <img src="{{ asset('imagenes/logo/logo_teach_2.png') }}" alt="logo" class="img-fluid">
                    <h2 class="h5">San Martín</h2><span>Liceo Pedagógico</span>
                </div>
                <!-- Información Minimizada-->
                <div class="sidenav-header-logo">
                    <a href="{{route('/')}}" class="brand-small text-center">
                        <img src="{{ asset('imagenes/logo/logo_teach_2.png') }}" alt="person" class="img-fluid img-responsive">
                    </a>
                </div>
            </div>
            <!-- Menu de Navegación-->
            <div class="main-menu">
                <h5 class="sidenav-heading"></h5>
                <ul id="side-main-menu" class="side-menu list-unstyled">
                    <li style="margin-top: 10px">
                        <a href="{{route('/')}}">
                            <i class="fas fa-home"></i>
                            <span  class="oculto">Inicio</span>
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('docentes')}}">
                            <i class="fas fa-user-plus"></i>
                            <span class="oculto">Docentes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('modulos')}}">
                            <i class="fas fa-suitcase"></i>
                            <span class="oculto">Módulos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('temas')}}">
                            <i class="fas fa-window-restore"> </i>
                            <span class="oculto">Temas</span>
                        </a>
                    </li>
                    <li>
                        <a
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="oculto"> Cerrar Sesión</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page">
        <!-- navbar-->
        <header class="header">
            <nav class="navbar main">
                <div class="container-fluid">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">
                        <div class="navbar-header">
                            <a id="toggle-btn" href="#" class="menu-btn">
                                <i class="fas fa-bars"> </i>
                            </a>
                        </div>
                        <div class="form-inline nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                            <span class="font-weight-bold mr-1 pt-2">{{ Auth::user()->name }}</span>
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-circle fa-w-16 fa-3x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!--Sección de Contenido-->
        <section class="statistics">
            <div class="container-fluid">
                <div class="row d-flex">
                    <div class="col-sm-12 col-xl-12" style="top: 50px">
                        @yield('contenido')
                    </div>
                </div>
            </div>
        </section>
        <footer class="main-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Trabajo de Grado &copy; 2018</p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p>Presentado a <a href="http://www.unisangil.edu.co" class="external text-info">Unisangil</a></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection

@section('scriptjs')
    {{--<script src="{{asset('admin/js/jquery.min.js')}}"></script>--}}
    <script src="{{asset('admin/js/grasp_mobile_progress_circle-1.0.0.min.js')}}"></script>
    <script src="{{asset('vendors/js/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{asset('vendors/js/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('vendors/js//malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"> </script>
    <script src="{{asset('admin/js/dashboard.js')}} "></script>
    <script>
        Vue.use(VeeValidate);
        Vue.use(VuePaginator);
    </script>
        @yield('scripts')
@endsection
