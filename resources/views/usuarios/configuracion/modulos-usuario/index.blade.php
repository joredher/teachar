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
    <section id="contenido">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <modulos :modulos="{{json_encode($modulos)}}">

                </modulos>
                {{--<cards-template></cards-template>--}}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('helpers.cards')
@endsection