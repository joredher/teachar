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
<span class="{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-top: 3%">
    @if ($errors->has('email'))
        <script>
            toastr.error('{{ $errors->first('email') }}' , '', {positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width'})
        </script>
    @endif
</span>
<span class="{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-top: 3%">
    @if ($errors->has('password'))
        <script>
            toastr.error('{{ $errors->first('password') }}' , '', {positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width'})
        </script>
    @endif
</span>
<span class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" style="margin-top: 3%">
    @if ($errors->has('password_confirmation'))
        <script>
            toastr.error('{{ $errors->first('password_confirmation') }}' , '', {positionClass: 'toast-top-full-width', containerId: 'toast-top-full-width'})
        </script>
    @endif
</span>
<script>console.clear();
    $(document).ready(function(){
        $("#email").on('paste', function(e){
            e.preventDefault();
            swal("Oops", "¡Acción no Permitida!", "error");
        });

        $("#password").on('paste', function(e){
            e.preventDefault();
            swal("Oops", "¡Acción no Permitida!", "error");

        });

        $("#password-confirm").on('paste', function(e){
            e.preventDefault();
            swal("Oops", "¡Acción no Permitida!", "error");

        });

        $("#email").on('copy', function(e){
            e.preventDefault();
            swal("Oops", "¡Acción no Permitida!", "error");
        });

        $("#password").on('copy', function(e){
            e.preventDefault();
            swal("Oops", "¡Acción no Permitida!", "error");
        });

        $("#password-confirm").on('copy', function(e){
            e.preventDefault();
            swal("Oops", "¡Acción no Permitida!", "error");
        });

        $(".btn_login").on('click', function (e) {
            // e.preventDefault();
            if ($('#email').val() === '' || $('#password').val() === '' || $('#password-confirm').val() === '' ){
                swal( "¡Vaya! " , "¡Ningún campo debe estar vacío! " , "warning" )   ;
            }

        })

    })
</script>

</body>
</html>
