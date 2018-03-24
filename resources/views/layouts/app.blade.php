<!doctype html>
<html lang="es" class="loaded">
    <head>
        <title> TeachAR | @yield('title')</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="csrf-token" id="token" content="{{ csrf_token() }}"  value="{{ csrf_token() }}">
        <meta name="description" content="Proyecto de Grado - Aplicativo Web con Realidad Aumentada">
        <meta name="author" content="Jorge Eduardo Hernández Oropeza y Edisson Fernando Quiñonez Díaz">
        <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
        <script defer src="{{ asset('js/fontawesome.js') }}"></script>
        <!-- Bootstrap core CSS -->
        <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
        <link rel="stylesheet" href="{{asset('vendors/css/buttons/ladda-themeless.min.css')}}">
        {{--<link rel="stylesheet" href="{{asset('css/preloader.css')}}">--}}
        {{--<link rel="stylesheet" href="{{asset('../../css/roboto.css')}}" type="text/css">--}}
        {{--<script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>--}}
        <link href="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css" rel="stylesheet" />
        <link href="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/vendors/css/forms/toggle/switchery.min.css" rel="stylesheet" />
        <link href="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/css/plugins/forms/switch.min.css" rel="stylesheet" />
        <link href="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/css/core/colors/palette-switch.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('vendors/js/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
        @yield('links')
    </head>
    <body class="capaFondo">

        @if(Auth::user()->hasRole('admin'))
            @yield('admin-content')
            <script src="{{asset('js/app.js')}}"></script>
        @elseif(Auth::user()->hasRole('profe'))
            @yield('content-profe')
            <script src="{{asset('js/ucomponents.js')}}"></script>
        @endif

        <!-- Bootstrap core JavaScript
           ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        {{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
        <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="{{asset('admin/js/popper.min.js')}}"></script>
        <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/toastr.js')}}"></script>
        <script src="{{asset('vendors/js/buttons/spin.min.js')}}"></script>
        <script src="{{asset('vendors/js/buttons/ladda.min.js')}}"></script>
        <script src="{{asset('vendors/js/extensions/listjs/list.min.js')}}"></script>
        <script src="{{asset('vendors/js/extensions/listjs/list.pagination.min.js')}}"></script>
        <script src="https://pixinvent.com/bootstrap-admin-template/robust/app-assets/vendors/js/forms/toggle/switchery.min.js"></script>
        {{--<script src="https://code.jquery.com/jquery-3.2.1.js"></script>--}}
        {{--<script src="{{asset('js/preloader.js')}}"></script>--}}

        @yield('scriptjs')
        <script>
            try{
                var laddaButton = Ladda.create(document.querySelector('.ladda-button-submit'));
                var laddaButtonSearch = Ladda.create(document.querySelector('.ladda-button-search'));
            }catch ( ee ){
                console.log('Falta definir lada button');
            }
        </script>
        <script src="{{asset('vendors/js//malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"> </script>

    </body>
</html>