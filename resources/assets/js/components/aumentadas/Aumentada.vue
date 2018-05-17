<template>
    <div>
        <div class="carga_mode">
            <img id="loader" src="/imagenes/preloader_ra.gif" alt="loading">
            <img id="error" src="/imagenes/error.png" alt="error">
        </div>
        <div v-for="objeto in tema.bd_objeto">
            <a-scene id="scene" stats arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;' >
            <!--  <a-scene id="scene"   embedded arjs='sourceType: webcam;' vr-mode-ui="enabled: false"  background="color: red">-->
                <a-assets>
                    <a-asset-item v-if="objeto.format === 'obj'" id="obj1" :src="'/storage/'+objeto.src" ></a-asset-item>
                    <a-asset-item v-if="objeto.format === 'obj'" id="mtl1" :src="'/storage/'+objeto.material" ></a-asset-item>
                    <!--<a-asset-item id="tree-obj"  src=""></a-asset-item>-->
                    <!--<a-asset-item id="tree-mtl"  src=""></a-asset-item>-->
                    <a-asset-item v-if="objeto.format === 'gltf'" id="gltf" :src="'/storage/' + objeto.src" ></a-asset-item>
                    <!--<a-asset-item id="tree-gltf" src="" ></a-asset-item>-->
                    <!--<a-asset-item id="tree-dae"  src="" ></a-asset-item>-->
                </a-assets>
                <!--<a-sky color="#DDDDDD"></a-sky>-->
                <!--<a-light type="directional" color="#FFF" intensity="0.5" position="-1 1 2"></a-light>-->
                <!--<a-light type="ambient" color="#FFF"></a-light>-->
                <!--<a-camera position="0 1 1" cursor-visible="true" cursor-scale="2" cursor-color="#0095DD" cursor-opacity="0.5"></a-camera>-->
                <!--<a-camera position="0 1 -1" cursor-visible="true" cursor-scale="2" cursor-color="#0095DD" cursor-opacity="0.5"></a-camera>-->
                <a-marker v-for="marker in markers" :key="marker.id" v-bind:preset="marker.name">
                    <a-entity light="type: hemisphere; color: #fefddd; groundColor: #fefddd; intensity: 1.2"></a-entity>
                    <a-entity >
                        <a-gltf-model id="crea_gltf" side="double" src="#gltf" position="0.0 0.2 0" scale="0.4 0.4 0.4">
                            <a-animation attribute="rotation" begin="rotate" end="endRotate" dur="26000" fill="forward" to="0 270 0" repeat="indefinite" easing="linear"></a-animation>
                        </a-gltf-model>
                    </a-entity>
                    <!--<a-obj-model src="#obj1" mtl="#mtl1" position="0 0 0" rotation="0 0 0" scale="2 2 2">-->
                        <!--&lt;!&ndash;<a-animation attribute="rotation" from="20 0 0" to="20 360 0" direction="alternate" dur="4000" repeat="indefinite" easing="ease"></a-animation>&ndash;&gt;-->
                    <!--</a-obj-model>-->
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

            <span class="orientacion-obj" onclick="CycleOrientation()">
                <img  id="marker-orientation" src="/imagenes/orientation_horizontal.png" alt="orientacion" >
            </span>
            <span id="marker-detection" onclick="CycleOrientation()"></span>
            <!--<span class="orientacion-obj" id="marker-orientation">-->
                <!--<i class="fas fa-random  fa-w-16 fa-3x"></i>-->
                <!--<i class="icon-shadow fas fa-random  fa-w-16 fa-3x"></i>-->
            <!--</span>-->

            <span class="arrow_left" id="leftArrow" @click="NextObjeto(-1)">
                <i class="fas fa-angle-double-left fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-angle-double-left fa-w-16 fa-3x"></i>
            </span>

            <span class="rotate-obj">
                <i class="fas fa-sync  fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-sync fa-w-16 fa-3x"></i>
            </span>

            <span class="arrow_right" id="rightArrow" @click="NextObjeto(+1)" >
                <i class="fas fa-angle-double-right fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-angle-double-right fa-w-16 fa-3x"></i>
            </span>

            <span class="expand-cam" onclick="screenfull.toggle()">
                <i class="fas fa-expand fa-w-16 fa-3x"></i>
                <i class="icon-shadow fas fa-expand fa-w-16 fa-3x"></i>
            </span>
        </div>
        <!--<div class="card bg-dark text-white" style="z-index: 99">-->
            <!--<pre>-->
                <!--{{ tema.bd_objeto }}-->
            <!--</pre>-->
        <!--</div>-->
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

                // aModel: [
                //     {
                //         // id: this.tema.bd_objeto[0].id,
                //         format: this.tema.bd_objeto[0].format,
                //         src: this.tema.bd_objeto[0].src,
                //         scale: '1 1 1',
                //         scaleInc: '0.8',
                //         positionH: '0.0 0.0 0.0',
                //         rotationH: '0.0 0.0 0.0',
                //         positionV: '0.0 0.0 0.0',
                //         rotationV: '0.0 0.0 0.0',
                //     }
                // ],

                // objetoCount: this.tema.bd_objeto.length,
                // objetoNbr: Math.floor(Math.random() * this.objetoCount)

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

            // var modelCount = this.tema.bd_objeto.length;
            // var modelNbr = Math.floor(Math.random() * modelCount);

            document.getElementById("loader").style.display = "none";
            // document.getElementById("error").style.display = "none";
            //
            // var vue = this;
            // console.log(vue.objetoNbr);
            // console.log(vue.aModel);
            // // $('#tree-gltf').setAttribute("src", 'storage/' + vue.tema.bd_objeto[vue.objetoNbr].modelo);
            //
            // if (vue.objeto === 1) {
            //     document.getElementById("leftArrow").style.display = "none";
            //     document.getElementById("rightArrow").style.display = "none";
            // }

        }

    }
</script>

<style scoped>

</style>