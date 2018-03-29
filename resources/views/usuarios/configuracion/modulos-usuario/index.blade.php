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
    <section id="ucontenido">
        <div class="ucontenido">
            <modulos  :modulos="{{json_encode($modulos)}}"></modulos>{{--<cards-template></cards-template>--}}
        </div>
    </section>
@endsection

@section('scripts')
    {{--<script src="{{asset('js/ucomponents.js')}}"></script>--}}

@endsection