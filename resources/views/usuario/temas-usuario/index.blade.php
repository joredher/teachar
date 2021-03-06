@extends('layouts.plantilla')

@section('into-back')
    <div class="into-back m-0 border-info bg-dark">
        {{--contenido de etrada index y de regreso--}}
        <div class="py-3 my-4">
            <div class="pr-5 pl-5">
                <div class="back mx-auto">
                    <a class="text-white underline" href="{{route('modulos-usuario')}}">
                        <i class="fas fa-chevron-left fa-w-10 fa-5x"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contenido-item','Temas de ' . $modulo->nombre)

@section('contenido')
    <section id="ucontenido">
        <temas :modulo="{{json_encode($modulo)}}"> </temas>
    </section>
@endsection

@section('scripts')

@endsection