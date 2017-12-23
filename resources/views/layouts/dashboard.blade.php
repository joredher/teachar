<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Proyecto de Grado - Aplicativo Web con Realidad Aumentada">
    <meta name="author" content="Jorge Eduardo Hernández Oropeza y Edisson Fernando Quiñonez Díaz">
    <link rel="icon" href="{{ asset('imagenes/logo/logo_teach_2.png') }}" type="image/png">

    <title>Admin | TeachAR</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- Link de Iconos: http://ionicons.com/#cdn -->
    <link href="{{asset('admin/css/dashboard.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/dashboardMediaQuery.css') }}">
    {{--<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
    {{--<link rel="stylesheet" href="{{asset('../../css/roboto.css')}}" type="text/css">--}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext,vietnamese" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>

</head>
<body class="capaFondo">
<div class="container-fluid">
    <div class="row">
        <header class="col-xs-12 col-sm-4 col-md-3 col-lg-3 col-xl-2 d-sm-block sidebar navFondo">
            <div class="card border-0">
                <div class="card-body text-center">
                    <img src="{{ asset('imagenes/logo/logo_teach_2.png') }}" alt="Logo" width="100px">
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <nav class="">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ URL::route('/') }}"><i class="fas fa-home"></i> Inicio<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="nav flex-column">
                    <li class="nav-item">
                    <span>
                        <a class="nav-link" href="{{ URL::route('docentes') }}"><i class="fas fa-user-plus"></i> Docentes</a>
                    </span>
                    </li>
                    <li class="nav-item">
                    <span>
                        <a class="nav-link" href="#"><i class="fas fa-suitcase"></i> Módulos</a>
                    </span>
                    </li>
                    <li class="nav-item">
                    <span>
                        <a class="nav-link" href="#"><i class="fas fa-window-restore"></i> Temas</a>
                    </span>
                    </li>

                </ul>
                <ul class="nav flex-column" >
                    <li class="nav-item">
                    <span>
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </span>
                    </li>
                </ul>
            </nav>
        </header>
        <main role="main" class="col-xs-12 col-sm-8 col-md-9 col-lg-9 col-xl-10 ml-sm-auto">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <nav class="navbar navbar-expand-md fixed-top main">
                        {{--<img src="{{ asset('imagenes/logo/logo_teach_2.png') }}" alt="logo" class="navbar-brand" width="100px">--}}
                        <h3><a href="{{ URL::route('/') }}"> LICEO PEDAGÓGICO SAN MARTÍN <span class="sr-only">(current)</span> </a></h3>
                    </nav>
                </div>
                <div class="col-sm-12 col-xl-12" style="top: 150px;">
                    @yield('contenido')
                </div>
            </div>
        </main>
     </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="{{asset('admin/js/popper.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>

@yield('scripts')
</body>
</html>

