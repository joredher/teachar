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
    <script src="{{asset('js/aumentadas/aframe.js')}}"></script>
    <script src="https://unpkg.com/aframe-gradient-sky@1.0.4/dist/gradientsky.min.js"></script>
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
                        {{--<input type="text" name="username" placeholder="Nombre de Usuario" id="user-username" required>--}}
                        <input type="text" name="login" placeholder="Correo o Nombre Usuario" id="user-username" required>
                    </div>
                    <div class="efecto-login">
                        <input type="password" name="password" placeholder="Contraseña" id="user-password" required>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Acceder" class="btn_login">
                        <a href="{{ route('password.request') }}">
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
    <a-scene fog="type: exponential; color: #39B3DF"   vr-mode-ui="enabled: false">
        <a-assets>
            {{--<a-img id="example" src="/imagenes/fondo_360-min.png"></a-img>--}}
            <a-img id="example" src="/imagenes/rotate_360-min.png"></a-img>
            <a-mixin id="glossy" material="roughness: 0; metalness: 0"></a-mixin>
            <a-asset-item id="boy" src="/imagenes/loggin_asset/model.gltf"></a-asset-item>
        </a-assets>

        <a-sky id="image-360" radius="10" phi-length="360" src="#example" opacity="0.8" segments-height="10">
            <a-animation attribute="rotation"
                         dur="100000"
                         fill="forwards"
                         to="0 360 0"
                         repeat="indefinite"
                         easing="linear"
                         direction="alternateReverse"></a-animation>
        </a-sky>

        {{--<a-entity gltf-model="#tree"></a-entity> 0 0.15 -4  --}}
        <a-entity position="-4 0.15 0" rotation="0 45 0" shadow="receive: true">
            <a-entity>
                <a-box color="#fff" position="0 0.0 0" width="2" height="0.29" depth="2"></a-box>
                <a-text color="#000" position="-0.95 0.15 0.8" value="UNISANGIL" rotation="270 180 180" width="8" height="0.5"></a-text>
                <a-gltf-model src="#boy" scale="2 2 2" position="0 6.1 1.5" rotation="-15 0 0"></a-gltf-model>
            </a-entity>
            <a-entity>
                <a-box mixin="glossy" color="#000" position="0 0 0" width="3" height="0.28" depth="3"></a-box>
            </a-entity>
        </a-entity>
        <!-- Globo -->
        <a-entity position="-4 3.25 0" shadow="receive: true">
            <a-entity geometry="primitive: sphere"
                      material="transparent: true;
                      opacity: 0.5; color: #fff;
                      roughness: 0.1; metalness: 0.3;
                      wireframe: true; wireframeLinewidth: 10;
                       emissive: #fff; emissiveIntensity: 1">
                <a-entity mixin="glossy" height="0.10" text="value:COMUNITIC; color:#000; shader: msdf; font:https://raw.githubusercontent.com/etiennepinchon/aframe-fonts/master/fonts/creepster/Creepster-Regular.json; align: center; width: 6; height:10; side: double;"></a-entity>
            </a-entity>
            <a-animation attribute="rotation"
                         dur="10000"
                         fill="forwards"
                         to="0 360 0"
                         repeat="indefinite"
                         easing="linear"></a-animation>
        </a-entity>

        <!-- Plano -->
        <a-plane material="roughness: 0.1; metalness: 0.1;" opacity="0.6" position="0 0 -4" rotation="-90 0 0" color="#A7D88A" width="500" height="500" shadow="receive: true"></a-plane>

        <!-- sky Material -->
        <a-entity id="sky" geometry="primitive: sphere; radius: 5000"
                  material="shader: gradient; topColor: 9 10 13; bottomColor: 23 32 45" scale="2 4 1"></a-entity>

        <!-- Luces -->
        <a-entity>
            <a-entity light="type: directional; castShadow: true" position="-5 16 16"></a-entity>
            <a-entity light="type: ambient; color: #444;"></a-entity>
        </a-entity>

        <a-entity  position="-2 2 3" rotation="-4 10 -4">
            <a-camera></a-camera>
        </a-entity>
    </a-scene>

    {{--<div id="clouds"></div>--}}
    {{--<div id="ground"></div>--}}
</div>
<script>console.clear();</script>
</body>
</html>