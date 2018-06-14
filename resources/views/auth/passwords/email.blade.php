<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}" value="{{ csrf_token() }}">
    <title>Teach AR</title>
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{asset('css/roboto.css')}}" type="text/css">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
</head>
<body class="container-reset">
    <div id="wrapper">
        <div class="loggin reset">
            <img src="{{asset('imagenes/logo/logo_teach_2.png')}}" alt="Imagen de Login">
            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <label for="reset"></label>
                <div>
                    <div class="efecto-login">
                        {{--<input type="text" name="username" placeholder="Nombre de Usuario" id="user-username" required>--}}
                        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Correo Electónico" required>
                    </div>
                    <div class="opcion">
                        <input type="submit" name="submit" value="Link Reset" class="btn_login">
                        <a href="{{ route('main') }}"><i class="fas fa-undo-alt"></i> Volver a Iniciar Sesión</a>
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
        <div id="clouds"></div>
        <div id="ground"></div>
    </div>
</div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
    <script src="{{asset('js/login.js')}}"></script>
    <script src="{{ asset('js/alert_sweet.js') }}"></script>
    @if (session('status'))
        <script>
                swal(
                    {
                        text: "{{ 'Ahora, ' . session('status') }}",
                        icon: "success",
                        buttons: false,
                        timer: 3500
                    }).then(timer => {
                        if (timer <= 0){
                            // window.open("http://localhost:8000/")
                            window.location.href = "{{ route('main') }}"
                        }
                })
        </script>
    @endif
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
</body>
</html>
