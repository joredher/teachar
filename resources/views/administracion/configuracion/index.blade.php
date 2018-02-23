@extends('layouts.dashboard')

@section('modulo-url', '#')
@section('modulo-nombre', '')

@section('contenido')

    <div class="panel-body">
        <div class="card border-0 bg-transparent" style="box-shadow: none">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-5">
                        <div class="card p-0 boxCard">
                            <div class="">
                                <img src="{{asset('imagenes/imagenAdmin2.jpg')}}" class="img-fluid" alt="">
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ Auth::user()->name.' '.Auth::user()->last_name }}</h4>
                                <h6 class="card-subtitle mb-2 text-muted">{{ Auth::user()->identification}}</h6>
                                <p class="card-text">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-7">


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection