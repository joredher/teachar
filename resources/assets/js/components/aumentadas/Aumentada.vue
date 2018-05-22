<template>
    <div>
        <div>
            <div class="carga_mode">
                <img id="loader" src="/imagenes/preloader_ra.gif" alt="loading">
                <img id="error" src="/imagenes/error.png" alt="error">
            </div>
            <div v-for="objeto in tema.bd_objeto">
                <a-scene id="scene" ejemplo stats arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;'>
                    <!--vr-mode-ui="enabled: false"-->
                    <a-assets>
                        <a-asset-item v-if="objeto.format === 'obj'" id="obj1" :src="'/storage/'+objeto.src" ></a-asset-item>
                        <a-asset-item v-if="objeto.format === 'obj'" id="mtl1" :src="'/storage/'+objeto.material" ></a-asset-item>
                        <a-asset-item v-if="objeto.format === 'gltf'" id="gltf" :src="'/storage/' + objeto.src" ></a-asset-item>
                    </a-assets>

                    <a-marker v-for="marker in markers" :key="marker.id" v-bind:preset="marker.name">
                        <a-entity light="type: hemisphere; color: #fefddd; groundColor: #fefddd; intensity: 1.2"></a-entity>
                        <!--<a-entity >-->
                        <a-gltf-model id="crea_gltf" side="double" src="#gltf" position="0.0 0.2 0" scale="1 1 1">
                            <a-animation attribute="rotation" begin="rotate" end="endRotate" dur="26000" fill="forward" to="0 270 0" repeat="indefinite" easing="linear"></a-animation>
                        </a-gltf-model>
                        <!--</a-entity>-->

                        <a-entity id="crea_obj" side="double" rotation="0 -90 0" position="0.0 0.9 0" scale="1 1 1" obj-model="obj: #obj1; mtl: #mtl1">
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
                <i class="fas fa-plus-circle fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-plus-circle fa-w-16 fa-3x"></i>
            </span>
                <span class="zoom-menus">
                <i class="fas fa-minus-circle  fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-minus-circle  fa-w-16 fa-3x"></i>
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
                <i class="fas fa-sync  fa-w-16 fa-4x"></i>
                <i class="icon-shadow fas fa-sync fa-w-16 fa-4x"></i>
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

                objetoCount: this.tema.bd_objeto.length,
                objetoNbr: Math.floor(Math.random() * this.objetoCount),
                // sceneEL: document.querySelector('a-scene'),
                // entityEL: document.querySelector('a-entity')
            }
        },
        methods:{

        },
        mounted() {

            console.clear();


            AFRAME.registerComponent('ejemplo', {
                init: function () {

                    var entityEL = document.querySelector('#crea_obj'), gltfModel = document.querySelector('#crea_gltf') ,
                        scaleBtn = $(".zoom-plus"), menusScale = $(".zoom-menus"), rotateBtn = $(".rotate-obj");

                    rotateBtn.click(function () {
                        if (rotateBtn.hasClass("rotate_fade")){
                            gtlfModel.emit('endRotate');
                            entityEL.emit('endRotate');
                            rotateBtn.removeClass("rotate_fade");
                        }else {
                            gtlfModel.emit('rotate');
                            entityEL.emit('rotate');
                            rotateBtn.addClass("rotate_fade");
                        }
                    });

                    var scaleFlag = 0;

                    scaleBtn.click(function () {
                        if (scaleFlag === 0){
                            scaleFlag = 1;
                            entityEL.object3D.scale.set(1.5, 1.5, 1.5);
                            gltfModel.object3D.scale.set(1.5, 1.5, 1.5);
                            // scaleBtn.addClass("scale_one");
                        }else if (scaleFlag === 1){
                            scaleFlag = 2;
                            entityEL.object3D.scale.set(2, 2, 2);
                            gltfModel.object3D.scale.set(2, 2, 2);
                            // scaleBtn.addClass("scale_two");
                            // scaleBtn.removeClass("scale_one");
                        }else if (scaleFlag === 2){
                            scaleFlag = 3;
                            entityEL.object3D.scale.set(2.5, 2.5, 2.5);
                            gltfModel.object3D.scale.set(2.5, 2.5, 2.5);
                            // scaleBtn.removeClass("scale_two");
                        }else if (scaleFlag === 3){
                            scaleFlag = 4;
                            entityEL.object3D.scale.set(3, 3, 3);
                            gltfModel.object3D.scale.set(3, 3, 3);
                            // scaleBtn.removeClass("scale_two");
                        }
                    });

                    menusScale.click(function () {
                        if (scaleFlag === 4){
                            scaleFlag = 3;
                            entityEL.object3D.scale.set(2.5, 2.5, 2.5);
                            gltfModel.object3D.scale.set(2.5, 2.5, 2.5);
                        }else if (scaleFlag === 3){
                            scaleFlag = 2;
                            entityEL.object3D.scale.set(2, 2, 2);
                            gltfModel.object3D.scale.set(2, 2, 2);
                        }else if (scaleFlag === 2){
                            scaleFlag = 1;
                            entityEL.object3D.scale.set(1.5, 1.5, 1.5);
                            gltfModel.object3D.scale.set(1.5, 1.5, 1.5);
                        }else if (scaleFlag === 1){
                            scaleFlag = 0;
                            entityEL.object3D.scale.set(1, 1, 1);
                            gltfModel.object3D.scale.set(1, 1, 1);
                        }
                    })

                    // console.log(this.sceneEl);
                }
            });



            var gtlfModel = document.querySelector('#crea_gltf'),
                objModel = document.querySelector('#crea_obj'),
                rotateBtn = $(".rotate-obj"),
                scaleBtn = $(".zoom-plus"),
                switchBtn = $(".arrow_right"),
                gotitBtn = $(".gotit");



            document.getElementById("loader").style.display = "none";
            document.getElementById("error").style.display = "none";
        }

    }
</script>

<style scoped>

</style>