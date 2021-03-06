<!doctype html>
<html lang="es" class="loaded">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Proyecto de Grado - Aplicativo Web con Realidad Aumentada">
    <meta name="author" content="Jorge Eduardo Hernández Oropeza y Edisson Fernando Quiñonez Díaz">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
    <link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('css/404.css')}}">
    <title> TeachAR | @yield('title')</title>

</head>
<body>
<!-- Error Page -->
<div id='oopss'>
    <div id='error-text'>
        @yield('imagen')
        <span>@yield('numero')</span>
        <p class="texto"> @yield('texto_uno')</p>
        <p class="texto2"> @yield('texto_dos')</p>
        <p class='hmpg'><a href="{{ \Illuminate\Support\Facades\URL::route('main') }}" class="back">VOLVER A INICIO</a></p>
    </div>
</div>
<!-- Error Page -->
{{--<script type="text/js" src="{{asset('js/404.js')}}"></script>--}}
</body>
</html>