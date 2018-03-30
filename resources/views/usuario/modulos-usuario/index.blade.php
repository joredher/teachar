@extends('layouts.plantilla')

@section('into-back')
    <div class="into-back border-info">
        {{--contenido de etrada index y de regreso--}}
        <div class="py-4 my-3 text-right">
            <div class="d-block mx-auto pl-5">
                <div class="into">
                    <img class="rounded-circle border border-top-0 border-dark" src="{{asset('imagenes/default_avatar_male.jpg')}}" alt="Avatar" width="72px">
                </div>
            </div>
        </div>
    </div>
    <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="text-dark">
                        <i class="fas fa-bars"></i>
                    </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <div>
                    <h4 class="text-bold mb-0"><strong>Lic. </strong>{{ Auth::user()->name.' '.Auth::user()->last_name }}</h4>
                </div>
                {{--<hr> Está etiqueta sirve para crear una línea--}}
                <div>
                    <p class="mb-0">
                        <small class="text-muted" style="padding-left: 2px">
                            <label>Liceo Pedagógico San Martín</label>
                        </small>
                    </p>
                </div>
            </li>
        </ul>
        <div class="form-inline mt-2 mt-md-0 pr-5 pulse animated">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="text-dark">
                <i class="fas fa-sign-out-alt fa-w-16 fa-2x">

                </i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

@section('contenido')
    <section id="ucontenido">
        <div class="ucontenido">
            <modulos  :modulos="{{json_encode($modulos)}}"></modulos>
        </div>
    </section>
@endsection

@section('scripts')

@endsection