@extends('layouts.plantilla')

@section('into-back')
    <div class="into-back border-info">
        {{--contenido de etrada index y de regreso--}}
        <div class="py-1 my-0">
            <div class="pr-5 pl-5 pb-2">
                <div class="into mx-auto">
                    <img class="rounded-circle border border-top-0 border-dark" src="{{asset('imagenes/default_avatar_male.jpg')}}" alt="Avatar" width="72px">
                </div>
            </div>
            <hr class="mt-0 mb-1">{{--Está etiqueta sirve para crear una línea--}}
            <div class="texto-modulo mx-auto text-center">
                <div><h6 class="text-bold mb-0"><strong>Lic. </strong>{{ auth()->user()->name }}</h6></div>
                <div>
                    <p class="mb-0">
                        <small class="text-muted" style="padding-left: 2px">
                            <label>Liceo Pedagógico San Martín</label>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contenido-item', 'MÓDULOS')

@section('contenido')
    <section id="ucontenido">
        <modulos  :modulos="{{json_encode($modulos)}}"></modulos>
    </section>
@endsection