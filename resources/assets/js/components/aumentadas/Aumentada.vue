<template>
    <div>
        <div class="carga_mode">
            <img id="loader" src="/imagenes/preloader_ra.gif" alt="loading">
            <img id="error" src="/imagenes/error.png" alt="error">
        </div>
        <div v-for="objeto in tema.bd_objeto">
            <a-scene id="scene" stats arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;' vr-mode-ui="enabled: false">
                <a-assets>
                    <a-asset-item v-if="objeto.format === 'obj'" id="obj1" :src="'/storage/'+objeto.src" ></a-asset-item>
                    <a-asset-item v-if="objeto.format === 'obj'" id="mtl1" :src="'/storage/'+objeto.material" ></a-asset-item>
                    <a-asset-item v-if="objeto.format === 'gltf'" id="gltf" :src="'/storage/' + objeto.src" ></a-asset-item>
                </a-assets>

                <a-marker v-for="marker in markers" :key="marker.id" v-bind:preset="marker.name">
                    <a-entity light="type: hemisphere; color: #fefddd; groundColor: #fefddd; intensity: 1.2"></a-entity>
                    <a-entity >
                        <a-gltf-model id="crea_gltf" side="double" src="#gltf" position="0.0 0.2 0" scale="0.4 0.4 0.4">
                            <a-animation attribute="rotation" begin="rotate" end="endRotate" dur="26000" fill="forward" to="0 270 0" repeat="indefinite" easing="linear"></a-animation>
                        </a-gltf-model>
                    </a-entity>

                    <a-entity id="crea_obj" side="double" rotation="0 -90 0" position="0.0 0.2 0" scale="0.4 0.4 0.4" obj-model="obj: #obj1; mtl: #mtl1">
                        <a-animation attribute="rotation" begin="rotate" end="endRotate" dur="26000" fill="forward" to="0 270 0" repeat="indefinite" easing="linear"></a-animation>
                    </a-entity>
                    <!--<a-entity gltf-model="#gltf" animation-mixer></a-entity>-->
                    <!--<a-entity obj-model="obj:'#prueba'; mtl:'#mtl1'"></a-entity>-->
                    <!--<a-entity gltf-model="#gltf"></a-entity>-->
                </a-marker>

                <a-entity camera></a-entity>
            </a-scene>
        </div>
        <div id="front" class="bounceIn">
            <span class="zoom-plus">
                <i class="fas fa-search-plus fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-search-plus fa-w-16 fa-3x"></i>
            </span>
            <span class="zoom-menus">
                <i class="fas fa-search-minus  fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-search-minus  fa-w-16 fa-3x"></i>
            </span>

            <span class="orientacion-obj">
                <img  id="marker-orientation" src="/imagenes/orientation_horizontal.png" alt="orientacion" >
            </span>
            <span id="marker-detection"></span>
            <!--<span class="orientacion-obj" id="marker-orientation">-->
                <!--<i class="fas fa-random  fa-w-16 fa-3x"></i>-->
                <!--<i class="icon-shadow fas fa-random  fa-w-16 fa-3x"></i>-->
            <!--</span>-->

            <span class="arrow_left" id="leftArrow" >
                <i class="fas fa-angle-double-left fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-angle-double-left fa-w-16 fa-3x"></i>
            </span>

            <span class="rotate-obj">
                <i class="fas fa-sync  fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-sync fa-w-16 fa-3x"></i>
            </span>

            <span class="arrow_right" id="rightArrow" >
                <i class="fas fa-angle-double-right fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-angle-double-right fa-w-16 fa-3x"></i>
            </span>

            <span class="expand-cam" onclick="screenfull.toggle()">
                <i class="fas fa-expand fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-expand fa-w-16 fa-3x"></i>
            </span>
        </div>
    </div>
</template>

<script>

    // import 'aframe'

    export default {
        name: "aumentadas",
        props:['tema'],
        created(){
          console.log(this.tema.bd_objeto);
        },
        computed:{

        },
        data: function () {
            return {
                markers:[
                    {
                        id: 1,
                        name: 'hiro',
                    },
                    {
                        id: 2,
                        name: 'kanji'
                    },
                ],
            }
        },
        methods:{


        },
        mounted() {

            console.clear();

            var gtlfModel = document.querySelector('#crea_gltf'),
                objModel = document.querySelector('#crea_obj'),
                rotateBtn = $(".rotate-obj"),
                scaleBtn = $(".zoom-plus"),
                switchBtn = $(".arrow_right"),
                gotitBtn = $(".gotit");

            rotateBtn.click(function () {
               if (rotateBtn.hasClass("rotate_fade")){
                   gtlfModel.emit('endRotate');
                   objModel.emit('endRotate');
                   rotateBtn.removeClass("rotate_fade");
               }else {
                   gtlfModel.emit('rotate');
                   objModel.emit('rotate');
                   rotateBtn.addClass("rotate_fade");
               }
            });

            var scaleFlag = 0, kyivFlag = false;

            scaleBtn.click(function () {
                if (scaleFlag == 0){
                    scaleFlag = 1;
                    gtlfModel.setAttribute("scale", scale="0.55 0.55 0.55");
                    objModel.setAttribute("scale", scale="0.55 0.55 0.55");
                    scaleBtn.addClass("scale_one");
                }else if (scaleFlag == 1){
                    scaleFlag = 2;
                    gtlfModel.setAttribute("scale", scale="0.7 0.7 0.7");
                    objModel.setAttribute("scale", scale="0.7 0.7 0.7");
                    scaleBtn.addClass("scale_two");
                    scaleBtn.removeClass("scale_one");
                }else if (scaleFlag == 2){
                    scaleFlag = 0;
                    gtlfModel.setAttribute("scale", scale="0.4 0.4 0.4");
                    objModel.setAttribute("scale", scale="0.4 0.4 0.4");
                    scaleBtn.removeClass("scale_two");
                }
            });

            switchBtn.click(function () {
                if (kyivFlag == false){
                    kyivFlag = true;
                    switchBtn.html("crea_gltf");
                    gtlfModel.setAttribute("visible", false);
                }else{
                    kyivFlag = false;
                    switchBtn.html('crea_gltf');
                    gtlfModel.setAttribute("visible", true);
                }
            });

            document.getElementById("loader").style.display = "none";
            document.getElementById("error").style.display = "none";
        }

    }
</script>

<style scoped>

</style>