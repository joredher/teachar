<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}" value="{{ csrf_token() }}">
    <title>Teach AR</title>
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('css/roboto.css')}}" type="text/css">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
</head>
<body>
<div id="wrapper">
    <div id="logginID">
        <div class="loggin">
            <img src="{{asset('imagenes/logo/logo_teach_2.png')}}" alt="Imagen de Login">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div>
                    <div class="efecto-login">
                        <input type="text" name="username" placeholder="Nombre de Usuario" id="user-username" required>
                    </div>
                    <div class="efecto-login">
                        <input type="password" name="password" placeholder="Contraseña" id="user-password" required>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Acceder" class="btn_login">
                        <a href="{{route('password.request')}}">
                            ¿Olvidó la contraseña?
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <footer>
            <div class="info">
                <div class="desarrolladores">
                    <p>Semillero COMUNITIC</p>
                    <p>Ingeniería de Sistemas</p>
                </div>
                <div class="desarrolladores">
                    <p>Edisson Fernando Quiñonez Díaz</p>
                    <p>Jorge Eduardo Hernández Oropeza</p>
                </div>
            </div>
            <p>
                © 2018 Trabajo de Grado | Política de Privacidad UNISANGIL.
            </p>
        </footer>
    </div>
    <div id="clouds"></div>
    <div id="ground"></div>
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
<script src="{{asset('js/login.js')}}"></script>
</body>
</html>