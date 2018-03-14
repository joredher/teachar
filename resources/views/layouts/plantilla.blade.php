@extends('layouts.app')

@section('title', 'Docente')


@section('links')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
@endsection

@section('content-profe')
        <header class="header">
            <!-- Navegación -->
            <nav class="navbar navbar-expand-md navbar-dark bg-white">
                {{--<div class="regresar">--}}
                    {{--<a class="navbar-brand" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/#">Fixed navbar</a>--}}
                {{--</div>--}}
                <div class="into-back border-info">
                    {{--contenido de etrada index y de regreso--}}
                    @yield('into-back')
                </div>
                <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-dark">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <div>
                                <h4 class="text-bold mb-0"><strong>Lic. </strong>{{ Auth::user()->name.' '.Auth::user()->last_name }}</h4>
                            </div>
                            {{--<hr> Está etiqueta sirve para crear una línea--}}
                            <div>
                                <p class="mb-0">
                                    <small class="text-muted" style="padding-left: 2px">
                                        <label>Liceo Pedagógico San Martín</label>
                                    </small>
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div class="form-inline mt-2 mt-md-0 pr-5">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="text-dark">
                            <i class="fas fa-sign-out-alt fa-w-16 fa-2x">

                            </i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Inicia contenido de Página -->
        <main role="main" class="container-fluid">
            @yield('contenido')
        </main>

        <footer class="footer">
            <div class="container">
                <span class="text-muted">TeachAR - Ciencias Básicas.</span>
            </div>
        </footer>
@endsection

@section('scriptjs')
    <script>
        // Vue.use(VeeValidate);
        Vue.use(VuePaginator);
    </script>
    @yield('scripts')

@endsection