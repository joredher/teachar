@extends('layouts.app')


@section('title', 'Admin')

@section('links')
    <link href="{{asset('admin/css/dashboard.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/dashboardMediaQuery.css') }}">
    @yield('estilos')
@endsection

@section('admin-content')
    <div class="container-fluid">
        <div class="row">
            <header class="col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-2 d-sm-block sidebar navFondo">
                <div class="card border-0">
                    <div class="card-body text-center">
                        <img src="{{ asset('imagenes/logo/logo_teach_2.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <nav class="">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ URL::route('/') }}"><i class="fas fa-home"></i> Inicio<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                    <span>
                        <a class="nav-link" href="{{ URL::route('docentes') }}"><i class="fas fa-user-plus"></i> Docentes</a>
                    </span>
                        </li>
                        <li class="nav-item">
                    <span>
                        <a class="nav-link" href="{{ URL::route('modulos') }}"><i class="fas fa-suitcase"></i> Módulos</a>
                    </span>
                        </li>
                        <li class="nav-item">
                    <span>
                        <a class="nav-link" href="{{ URL::route('temas') }}"><i class="fas fa-window-restore"></i> Temas</a>
                    </span>
                        </li>

                    </ul>
                    <ul class="nav flex-column" >
                        <li class="nav-item">
                    <span>
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </span>
                        </li>
                    </ul>
                </nav>
            </header>
            <main role="main" class="col-xs-12 col-sm-8 col-md-9 col-lg-9 col-xl-10 ml-sm-auto">
                <div class="row">
                    <div class="col-sm-12 col-xl-12">
                        <nav class="navbar navbar-expand-md fixed-top main">
                            {{--<img src="{{ asset('imagenes/logo/logo_teach_2.png') }}" alt="logo" class="navbar-brand" width="100px">--}}
                            <h3><a href="{{ URL::route('/') }}"> LICEO PEDAGÓGICO SAN MARTÍN <span class="sr-only">(current)</span> </a></h3>
                        </nav>
                    </div>
                    <div class="col-sm-12 col-xl-12" style="top: 150px;">
                        @yield('contenido')
                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection

@section('scriptjs')
    <script>
        Vue.use(VeeValidate);
        Vue.use(VuePaginator);
    </script>
        @yield('scripts')
@endsection
