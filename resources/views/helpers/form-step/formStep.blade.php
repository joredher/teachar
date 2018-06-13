<!doctype html>
<html lang="es" class="loaded">
<head>
    <title>TeachAR | Tutorial Docente</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}"  value="{{ csrf_token() }}">
    <meta name="description" content="Proyecto de Grado - Aplicativo Web con Realidad Aumentada">
    <meta name="author" content="Jorge Eduardo Hernández Oropeza y Edisson Fernando Quiñonez Díaz">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('css/aumentadas/vue-form-wizard.min.css') }}">--}}
    <style>
        html {
            overflow: scroll;
        }
        /*@media (max-width: 575.99px) {}*/
    </style>
</head>
<body class="bodyStep">
<div id="ucontenido">
    <div class="previewStep">
        <previstas :user="{{json_encode($user)}}"></previstas>
    </div>
</div>
{{--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>--}}
<script src="{{asset('js/ucomponents.js')}}"></script>
{{--<script src="{{ asset('js/aumentadas/vue-form-wizard.js') }}"></script>--}}
</body>
</html>