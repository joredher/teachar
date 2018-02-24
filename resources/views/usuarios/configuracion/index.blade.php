@extends('layouts.plantilla')

@section('contenido')
    <div class="panel-body">
        <div class="card border-0">
            <div class="card-body">
                {{--<div><a href="#" class="btn-home animate btn-new-1"><i class="icon ion-person-add"></i> Usuarios</a></div>--}}
                {{--<div><a href="#" class="btn-home animate btn-new-2"><i class="icon ion-ios-albums"></i> Módulos</a></div>--}}
                {{--<div><a href="#" class="btn-home animate btn-new-3"><i class="icon ion-ios-albums"></i> Temas</a></div>--}}

                {{--<h1> Bienvenido {{ Auth::user()->name }}</h1>--}}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-5">
                        <div class="card p-0 boxCard">
                            <div class="">
                                <img src="{{asset('imagenes/imagenAdmin2.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ Auth::user()->name.' '.Auth::user()->last_name }}</h4>
                                <h6 class="card-subtitle mb-2 text-muted">{{ Auth::user()->identification}}</h6>
                                <p class="card-text">
                                    {{ Auth::user()->email }}
                                    {{--Ser administrador es tener la visión,--}}
                                    {{--y capacidad de aplicar, desarrollar,--}}
                                    {{--planificar, organizar, direccionar y--}}
                                    {{--tener el control en una institución.--}}
                                </p>
                                {{--<a href="#" class="btn btn-dark">Iniciar</a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-7">


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <a href="#" class="card-header" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                Hola {{ Auth::user()->name }} <span class="caret"></span>
            </a>
        </div>
    </div>
@endsection