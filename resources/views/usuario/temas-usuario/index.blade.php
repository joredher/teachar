@extends('layouts.plantilla')

@section('into-back')
    <div class="into-back border-dark border-right">
        <div class="py-3 my-3 text-right">
            <div class="d-block mx-auto pr-5">
                <div class="back">
                    <a class="text-dark underline" href="{{route('index')}}">
                        <i class="fas fa-chevron-left fa-w-10 fa-6x"></i>
                    </a>
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
                    {{--<h4 class="text-bold mb-0"><strong>Lic. </strong>{{ Auth::user()->name.' '.Auth::user()->last_name }}</h4>--}}
                </div>
            </li>
        </ul>
        {{--<div class="form-inline mt-2 mt-md-0 pr-5 pulse animated">--}}
            {{--<a href="{{ route('logout') }}" onclick="event.preventDefault();--}}
                        {{--document.getElementById('logout-form').submit();" class="text-dark">--}}
                {{--<i class="fas fa-sign-out-alt fa-w-16 fa-2x">--}}

                {{--</i>--}}
            {{--</a>--}}
            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                {{--{{ csrf_field() }}--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
@endsection

@section('contenido')
    <section id="ucontenido">
        <div class="ucontenido">
            <temas  :modulo="{{json_encode($modulo)}}"> </temas>
        </div>
    </section>
@endsection

@section('scripts')

@endsection