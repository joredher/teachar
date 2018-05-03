<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba RA</title>
</head>
<script src="https://aframe.io/releases/0.8.0/aframe.min.js"></script>
<script src="https://cdn.rawgit.com/jeromeetienne/AR.js/1.5.5/aframe/build/aframe-ar.js"></script>
{{--<script src="https://aframe.io/releases/0.5.0/aframe.min.js"></script>--}}
{{--<script src="https://rawgit.com/jeromeetienne/ar.js/master/aframe/build/aframe-ar.js"></script>--}}
{{--<script>THREEx.ArToolkitContext.baseURL = 'https://rawgit.com/jeromeetienne/ar.js/master/three.js'</script>--}}
<body style="margin: 0px; overflow: hidden;">

    <a-scene embedded artoolkit='sourceType: webcam;'>
        {{--<a-box position='0 0.5 0' material='opacity: 0.5;'></a-box>--}}
        <a-sphere position='0 0.5 0' color="red"></a-sphere>
        <a-marker-camera preset='hiro'></a-marker-camera>
    </a-scene>

</body>
</html>