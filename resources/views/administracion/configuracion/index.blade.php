@extends('layouts.dashboard')

@section('modulo-url', '#')
@section('modulo-nombre', '')

@section('contenido')

    <div class="panel-body">
        <div class="card border-0 bg-transparent" style="box-shadow: none">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8 col-xl-5">
                        <!--div class="card p-0 boxCard">
                            <div class="">
                                {{--<img src="{{asset('imagenes/imagenAdmin2.jpg')}}" class="img-fluid" alt="">--}}
                            </div>
                            <div class="card-body text-center">
                                {{--<h4 class="card-title">{{ Auth::user()->name.' '.Auth::user()->last_name }}</h4>--}}
                                {{--<h6 class="card-subtitle mb-2 text-muted">{{ Auth::user()->identification}}</h6>--}}
                                <p class="card-text">
                                    {{--{{ Auth::user()->email }}--}}
                                </p>
                            </div>
                        </div-->
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-7">
                        <div class="card">
                            <div class="card-header pb-1 text-center">
                                <h2>Usuarios Online</h2>
                            </div>
                            <div class="card-body">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="bg-info bg-light">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\Illuminate\Support\Facades\Auth::user()->all() as $user)
                                                <tr>
                                                    <td>{{$user->name}}</td>
                                                    <td>
                                                        @if($user->isOnline())
                                                            <li class="text-success d-block">
                                                                Online
                                                            </li>
                                                        @else
                                                            <li class="text-muted d-block">
                                                                Offline
                                                            </li>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection