<!doctype html>
<html lang="es" class="loaded">
<head>
    <title>TeachAR | Modo Mantenimiento</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}"  value="{{ csrf_token() }}">
    <meta name="description" content="Proyecto de Grado - Aplicativo Web con Realidad Aumentada">
    <meta name="author" content="Jorge Eduardo Hernández Oropeza y Edisson Fernando Quiñonez Díaz">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
<div class="row ml-0 mr-0">
    <div class="col-sm-12">
        <div class="text-center">
            <div class="card border-0" style="margin: 0 auto;">
                <img class="card-img-top" width="30%" src="{{ asset('imagenes/modo_mantenimiento.jpg') }}" alt="mantenimiento">
                <div class="card-body pt-0">
                    <h3 class="card-title">¡Regresaremos pronto!</h3>
                    <article>
                        <div>
                            <p class="card-text">Pedimos disculpas por los inconvenientes causados pero estamos trabajando en cosas interesantes.</p>
                            <p class="card-text">¡Pronto estaremos en línea de nuevo!</p>
                            <p class="card-text">&mdash; El equipo TeachAR</p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="{{asset('admin/js/popper.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
</body>
</html>