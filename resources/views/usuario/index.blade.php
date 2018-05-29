<!DOCTYPE html>
<html lang="es" class="loaded">
<head>
    <title> TeachAR | Docente</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}"  value="{{ csrf_token() }}">
    <meta name="description" content="Proyecto de Grado - Aplicativo Web con Realidad Aumentada">
    <meta name="author" content="Jorge Eduardo Hernández Oropeza y Edisson Fernando Quiñonez Díaz">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
    <script defer src="{{ asset('js/fontawesome.js') }}"></script>

    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{asset('css/user.css')}}">
</head>
<body class="body_primero">
    <div class="contenedor-general">
        <div class="layout_contenedor" id="izquierda">
            <div class="centro">
                <div class="card intro" data-toggle="popover" data-trigger="hover">
                    <div class="card-header border-bottom-0">
                        <img src="{{asset('imagenes/default_avatar_male.jpg')}}" alt="user">
                    </div>
                    <div class="card-body p-3">
                        <h5 class="card-title mb-0">{{ Auth::user()->name .' '. Auth::user()->last_name }}</h5>
                        <h6 class="card-subtitle text-muted mt-0">
                            @if(Auth::user()->isOnline())
                                <i class="fab fa-cuttlefish text-success"></i>
                                {{ Auth::user()->identification }}
                            @else
                                <i class="fab fa-cuttlefish"></i>
                                {{ Auth::user()->identification }}
                            @endif
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="layout_contenedor" id="derecha">
            <div class="centro">
                <a class="moon" href="{{route('index')}}">
                    <img id="aparecer" src="{{ asset('imagenes/logo/logo_teach_2.png') }}" alt="Teach AR">
                    <img id="desaparecer" src="{{ asset('imagenes/logo/logo_teach_2.svg') }}" alt="Teach AR">
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="{{asset('admin/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function($) {

            $('[data-toggle="popover"]').popover({
                'placement': 'bottom',
                'content': '¡Bienvenido Profe!'
            });

            $(".moon").popover({
                'placement': 'left',
                'title': '¡Inicia Ahora!',
                'content': 'Solo con un Click.'
            });

            $('.moon').popover('show');
        });
    </script>

</body>
</html>