<!doctype html>
<html lang="es" class="loaded">
<head>
    <title> TeachAR | Docente</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}"  value="{{ csrf_token() }}">
    <meta name="description" content="Proyecto de Grado - Aplicativo Web con Realidad Aumentada">
    <meta name="author" content="Jorge Eduardo Hernández Oropeza y Edisson Fernando Quiñonez Díaz">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
    <script defer src="{{ asset('js/fontawesome.js') }}"></script>

    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{asset('css/user.css')}}">

</head>
<body class="body_primero">
    <div class="contenedor-general">
        <div class="layout_contenedor" id="izquierda">
            <div class="centro">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <img src="{{asset('imagenes/default_avatar_male.jpg')}}" alt="user">
                    </div>
                    <div class="card-body p-3">
                        <h5 class="card-title mb-0">{{ Auth::user()->name .' '. Auth::user()->last_name }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="layout_contenedor" id="derecha">
            <div class="centro">
                <a href="{{route('index')}}">
                    <img id="aparecer" src="{{ asset('imagenes/logo/logo_teach_2.png') }}" alt="Teach AR">
                    <img id="desaparecer" src="{{ asset('imagenes/logo/logo_teach_2.svg') }}" alt="Teach AR">
                </a>
            </div>
        </div>
    </div>

    {{--<nav class="navbar fixed-bottom navbar-light bg-light">--}}
        {{--<a href="#" class="navbar-brand">HOLA MUNDO</a>--}}
    {{--</nav>--}}

    <script src="{{asset('admin/js/popper.min.js')}}"></script>

</body>
</html>
{{--@extends('layouts.plantilla')--}}

{{--@section('into-back')--}}
    {{--<div class="py-4 my-3 text-right">--}}
        {{--<div class="d-block mx-auto pl-5">--}}
            {{--<div class="into">--}}
                {{--<img class="rounded-circle border border-top-0 border-dark" src="{{asset('imagenes/default_avatar_male.jpg')}}" alt="Avatar" width="72px">--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}

{{--@section('contenido')--}}
    {{--<div class="form-group">--}}
        {{--<div class="text-center">--}}
            {{--<a href="{{route('index')}}" class="underline text-dark">--}}
                {{--<i class="fas fa-home fa-w-16 fa-2x"></i>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}