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
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
</head>
<body class="container-reset link_reset">

<div id="wrapper">
    <div class="loggin">
        <img src="{{asset('imagenes/logo/logo_teach_2.png')}}" alt="Imagen de Login">
        <form method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">
            <div>
                <div class="efecto-login">
                    <input id="email" type="email" placeholder="Ingrese correo electrónico" name="email" value="{{ $email or old('email') }}" required autofocus>
                </div>
                <div class="efecto-login">
                    <input id="password" placeholder="Ingrese nueva contraseña" type="password" name="password" required>
                </div>
                <div class="efecto-login">
                    <input id="password-confirm" type="password" placeholder="Confirme nueva contraseña" name="password_confirmation" required>
                </div>

                <div class="opcion">
                    <input type="submit" name="submit"  value="Enviar" class="btn_login">
                    <a href="#">¡Oprime Enviar para Restablecer!</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{ asset('js/alert_sweet.min.js') }}"></script>
<span class="{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-top: 3%">
    @if ($errors->has('email'))
        <script>
            swal({
                title: 'Oops',
                text: '{{ $errors->first('email') }}',
                icon: "error",
                className: "red-bg",
                buttons: false,
                timer: 4000,
            });
        </script>
    @endif
</span>
<span class="{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-top: 3%">
    @if ($errors->has('password'))
        <script>
            swal({
                title: 'Oops',
                text: '{{ $errors->first('password') }}',
                icon: "error",
                className: "red-bg",
                buttons: false,
                timer: 4000,
            });
        </script>
    @endif
</span>
<span class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" style="margin-top: 3%">
    @if ($errors->has('password_confirmation'))
        <script>
            swal({
                title: 'Oops',
                text: '{{ $errors->first('password_confirmation') }}',
                icon: "error",
                className: "red-bg",
                buttons: false,
                timer: 4000,
            });
        </script>
    @endif
</span>
</body>
</html>
