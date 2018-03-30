@extends('layouts.app')

@section('title', 'Docente')


@section('links')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
@endsection

@section('content-profe')
        <header class="header">
            <!-- Navegación -->
            <nav class="navbar navbar-expand-md navbar-dark bg-white">
                @yield('into-back')

            </nav>
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