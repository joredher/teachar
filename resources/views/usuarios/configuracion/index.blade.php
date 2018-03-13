@extends('layouts.plantilla')

@section('into-back')
    <div class="py-4 my-3 text-right">
        <div class="d-block mx-auto pl-5">
            <div class="into">
                <img class="rounded-circle border border-top-0 border-dark" src="{{asset('imagenes/default_avatar_male.jpg')}}" alt="Avatar" width="72px">
            </div>
        </div>
    </div>
@endsection

@section('contenido')
    <div class="panel-body">
        <div class="card border-0">
            <div class="card-body">
                {{--<div><a href="#" class="btn-home animate btn-new-1"><i class="icon ion-person-add"></i> Usuarios</a></div>--}}
                {{--<div><a href="#" class="btn-home animate btn-new-2"><i class="icon ion-ios-albums"></i> Módulos</a></div>--}}
                {{--<div><a href="#" class="btn-home animate btn-new-3"><i class="icon ion-ios-albums"></i> Temas</a></div>--}}

                {{--<h1> Bienvenido {{ Auth::user()->name }}</h1>--}}
                <div class="row">

                </div>
            </div>
        </div>
    </div>
@endsection