<!doctype html>
<html lang="es" class="loaded">
<head>
    <title> Paso a Paso</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}"  value="{{ csrf_token() }}">
    <meta name="description" content="Proyecto de Grado - Aplicativo Web con Realidad Aumentada">
    <meta name="author" content="Jorge Eduardo Hernández Oropeza y Edisson Fernando Quiñonez Díaz">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
    {{--<script defer src="{{ asset('js/fontawesome.js') }}"></script>--}}
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aumentadas/vue-form-wizard.min.css') }}">
</head>
<body>
<style>
    .wizard-header{
        display: none;
    }
</style>
<div id="ucontenido">
        <form-wizard @on-complete="onComplete"
                     shape="square"
                     color="#3498db"
                     back-button-text="Anterior"
                     next-button-text="Siguiente"
                     finish-button-text="Finalizar" finish="{{ route('index') }}">
            <tab-content title="Personal details"
                         icon="far fa-file-alt">
                My first tab content
            </tab-content>
            <tab-content title="Additional Info"
                         icon="fas fa-cube">
                My second tab content
            </tab-content>
            <tab-content title="Last step"
                         icon="far fa-play-circle">
                Yuhuuu! This seems pretty damn simple
            </tab-content>
        </form-wizard>
</div>
{{--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>--}}
<script src="{{asset('js/ucomponents.js')}}"></script>
<script src="{{ asset('js/aumentadas/vue-form-wizard.js') }}"></script>
</body>
</html>