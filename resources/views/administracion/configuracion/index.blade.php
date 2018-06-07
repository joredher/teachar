@extends('layouts.dashboard')

@section('modulo-url', '#')
@section('modulo-nombre', '')

@section('contenido')
    <style type="text/css">
        thead, tbody, tr, td, th {
            display: block;
        }

        tbody {
            overflow-y: auto;
            height: 150px;
        }

        tbody td, thead th {
            float: left;
            width: 50%;
        }

        tr:after {
            clear: both;
            content: ' ';
            display: block;
            visibility: hidden;
        }
    </style>

    <div class="panel-body">
        <div class="card border-0 bg-transparent" style="box-shadow: none">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 pb-5 col-md-12 col-lg-6 col-xl-6">
                        <div class="card pb-1 boxCard">
                            <div class="card-header text-center">
                                <h3 class="card-title">TeachAR | Admin</h3>
                            </div>
                            <div class="card-body text-justify">
                                <p class="card-text mb-4">
                                    El panel de administración de la plataforma TeachAR
                                    esta constituido en tres diferentes opciones de registro
                                    de datos y otra independiente para la carga de los objetos.
                                </p>
                                <ul class="nav justify-content-center">
                                    <li class="nav-item m-4"><a href="{{ route('docentes') }}" class="nav-link userDocentes"><i class="fas fa-user-plus fa-w-16 fa-2x iconActive"></i></a></li>
                                    <li class="nav-item m-4"><a href="{{ route('modulos') }}" class="nav-link userModulos"><i class="fas fa-archive fa-w-16 fa-2x iconActive"></i></a></li>
                                    <li class="nav-item m-4"><a href="{{ route('temas') }}" class="nav-link userTemas"><i class="fas fa-window-restore fa-w-16 fa-2x iconActive"></i></a></li>
                                    <li class="nav-item m-4"><a href="{{ route('objetos') }}" class="nav-link userObjetos"><i class="fas fa-box fa-w-16 fa-2x iconActive"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 pb-5 col-md-12 col-lg-6 col-xl-6">
                        <div class="card boxCard">
                            <div class="card-header text-center">
                                <h3 class="card-title">Usuarios Online</h3>
                            </div>
                            <div class="card-body pr-0 pl-0 pb-0">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="bg-info bg-light">
                                            <tr>
                                                <th>Nombre</th>
                                                <th>En Actividad</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\Illuminate\Support\Facades\Auth::user()->all() as $user)
                                                <tr>
                                                    @if($user->state == 'Activo')
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
                                                    @endif
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
@section('scripts')
    <script>

        $('.userDocentes').tooltip({
           'show':true,
           'placement': 'top',
           'title': 'Ir a registrar docentes..'
        });
        $('.userModulos').tooltip({
            'show':true,
            'placement': 'top',
            'title': 'Ir a registrar módulos..'
        });
        $('.userTemas').tooltip({
            'show':true,
            'placement': 'top',
            'title': 'Ir a registrar temas..'
        });
        $('.userObjetos').tooltip({
            'show':true,
            'placement': 'top',
            'title': 'Ir a registrar assets..'
        });
    </script>
@endsection