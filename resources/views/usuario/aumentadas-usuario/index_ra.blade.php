<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,shrink-to-fit=no,user-scalable=no,minimal-ui">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}"  value="{{ csrf_token() }}">
    <meta name="description" content="Proyecto de Grado - Aplicativo Web con Realidad Aumentada">
    <meta name="author" content="Jorge Eduardo Hernández Oropeza y Edisson Fernando Quiñonez Díaz">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/aumentadas/aumentadas.css') }}">
    <title>Prueba RA</title>
    <script src="https://aframe.io/releases/0.8.0/aframe.min.js"></script>
    <script src="{{ asset('js/aumentadas/aframe-ar.js') }}"></script>
</head>
<body>
<section id="ucontenido">
    <div class="ucontenido">
        <aumentadas  :tema="{{ json_encode($tema) }}"></aumentadas>
    </div>
</section>

<script src="{{asset('js/ucomponents.js')}}"></script>
{{--<script src="{{asset('js/aumentadas/webar.js')}}"></script>--}}
</body>
</html>