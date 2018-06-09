<template>
    <div>
        <div>
            <!--<div class="carga_mode">-->
            <img id="loader" src="/imagenes/preloader_ra.gif" alt="loading">
            <img id="error" src="/imagenes/error.png" alt="error">
            <!--</div>-->
            <div>
                <a-scene id="scene" ejemplo stats="false" arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;'>
                    <!--vr-mode-ui="enabled: false" v-for="objeto in tema.bd_objeto"-->
                    <a-assets>
                        <!--<a-asset-item v-if="objeto.format === 'obj'" id="obj1" :src="'/storage/'+objeto.src" ></a-asset-item>-->
                        <!--<a-asset-item v-if="objeto.format === 'obj'" id="mtl1" :src="'/storage/'+objeto.material" ></a-asset-item>-->
                        <!--<a-asset-item v-if="objeto.format === 'gltf'" id="gltf" :src="'/storage/' + objeto.src" ></a-asset-item> -->

                        <a-asset-item  id="obj1" src="" ></a-asset-item>
                        <a-asset-item  id="mtl1" src="" ></a-asset-item>
                        <a-asset-item  id="gltf1" src="" ></a-asset-item>
                    </a-assets>

                    <a-marker v-for="marker in markers" :key="marker.id" v-bind:preset="marker.name" v-bind:url='marker.url' v-bind:type='marker.type'>
                        <a-entity light="type: hemisphere; color: #fefddd; groundColor: #fefddd; intensity: 1.2"></a-entity>

                        <a-entity
                                name="rotation"
                                animation="
                                property:rotation;
                                dir:alternate;
                                easing: linear;
                                dur: 10000;
                                loop: true;
                                startEvents: rotation-start;
                                pauseEvents: rotation-pause;
                                resumeEvents: rotation-resume;
                                restartEvents: rotation-restart;">
                            <a-entity
                                    name="model"
                                    id="crea"
                                    animation-mixer
                                    animation__position="
                                    property: position;
                                    easing: easeInOutBack;
                                    dur: 300;
                                    startEvents: zoom-start;"
                                    animation__scale="
                                    property: scale;
                                    easing: easeInOutBack;
                                    dur: 300;
                                    startEvents: zoom-start;">
                                <!-- side="double"<a-animation attribute="rotation" begin="rotate" end="endRotate" dur="26000" fill="forward" to="0 360 0" repeat="indefinite" easing="linear"></a-animation>-->
                            </a-entity>
                            <a-animation
                                    attribute="scale"
                                    begin="fadein"
                                    from="0 0 0"
                                    to="1 1 1"
                                    dur="500">
                            </a-animation>
                        </a-entity>

                        <!--<a-entity >-->
                        <!--<a-gltf-model id="crea_gltf" side="double" src="#gltf" position="0 0 0" scale="1 1 1">-->
                            <!--<a-animation attribute="rotation" begin="rotate" end="endRotate" dur="26000" fill="forward" to="0 360 0" repeat="indefinite" easing="linear"></a-animation>-->
                        <!--</a-gltf-model>-->
                        <!--</a-entity>-->

                        <!--<a-entity id="crea_obj" side="double" rotation="0 -90 0" position="0.0 0.0 0.0" scale="1 1 1" obj-model="obj: #obj1; mtl: #mtl1">-->
                            <!--<a-animation attribute="rotation" begin="rotate" end="endRotate" dur="26000" fill="forward" to="0 360 0" repeat="indefinite" easing="linear"></a-animation>-->
                        <!--</a-entity>-->
                        <!--<a-entity gltf-model="#gltf" animation-mixer></a-entity>-->
                        <!--<a-entity obj-model="obj:'#prueba'; mtl:'#mtl1'"></a-entity>-->
                        <!--<a-entity gltf-model="#gltf"></a-entity>-->
                    </a-marker>

                    <a-entity camera></a-entity>
                </a-scene>
            </div>
            <div id="front" class="bounceIn">
                <a  class="return-tema btn btn_push bg-warning btn-warning border-bottom " :href="'/usuario/modulo/' + tema.bd_modulo.slug">
                    <i class="fas fa-caret-left fa-w-16 fa-3x"></i>
                    <i class="icon-shadow fas fa-caret-left fa-w-16 fa-3x"></i>
                </a>
                <a  class="video-info btn btn_push"  data-toggle="modal" data-target="#myVideo"  @click.prevent="mostrar(tema)" >
                    <i class="fas fa-lightbulb fa-w-16 fa-3x"></i>
                    <i class="icon-shadow fas fa-lightbulb fa-w-16 fa-3x"></i>
                </a>
                <span class="zoom-plus" @click.prevent="Zoom(tema,+1)">
                    <i class="fas fa-plus-circle fa-w-16 fa-3x"></i>
                    <i class="icon-shadow fas fa-plus-circle fa-w-16 fa-3x"></i>
                </span>
                 <span class="zoom-menus" @click.prevent="Zoom(tema, -1)">
                    <i class="fas fa-minus-circle  fa-w-16 fa-3x"></i>
                    <i class="icon-shadow fas fa-minus-circle  fa-w-16 fa-3x"></i>
                </span>

                <span class="orientacion-obj" @click.prevent="CycleOrientation(tema)">
                    <img  id="marker-orientation" src="/imagenes/orientation_horizontal.png" alt="orientacion" >
                </span>
                <span id="marker-detection" @click.prevent="CycleOrientation(tema)"></span>
                    <!--span class="orientacion-obj" id="marker-orientation">
                    <i class="fas fa-random  fa-w-16 fa-3x"></i>
                    <i class="icon-shadow fas fa-random  fa-w-16 fa-3x"></i>
                    </span-->
                <span class="arrow_left" id="leftArrow" @click.prevent="NextModel(-1, tema)">
                    <i class="fas fa-angle-double-left fa-w-16 fa-3x"></i>
                    <i class="icon-shadow fas fa-angle-double-left fa-w-16 fa-3x"></i>
                </span>

                <span class="rotate-obj" @click.prevent="RotationOnOff()">
                    <i class="fas fa-sync  fa-w-16 fa-4x"></i>
                    <i class="icon-shadow fas fa-sync fa-w-16 fa-4x"></i>
                </span>

                <span class="arrow_right" id="rightArrow" @click.prevent="NextModel(+1, tema)">
                    <i class="fas fa-angle-double-right fa-w-16 fa-3x"></i>
                    <i class="icon-shadow fas fa-angle-double-right fa-w-16 fa-3x"></i>
                </span>

                <span class="expand-cam" onclick="screenfull.toggle()">
                    <i class="fas fa-expand fa-w-16 fa-3x"></i>
                    <i class="icon-shadow fas fa-expand fa-w-16 fa-3x"></i>
                </span>
            </div>
            <div class="modal fade" id="myVideo" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-mask">
                  <div class="modal-dialog modal-dialog-centered modal-lg modal-wrapper" role="document">
                      <div class="modal-content modal-container bg-transparent border-0">
                          <div class="modal-header border-0 p-0">
                              <h5 class="modal-title text-white" id="exampleModalCenterTitle" v-text="'Video Informativo: ' + tema.nombre"></h5>
                              <a class="bg-transparent text-white" data-dismiss="modal" aria-label="Close">
                                  <span class="" aria-hidden="true"><i class="fas fa-times fa-2x text-white"></i></span>
                              </a>
                          </div>
                          <div class="modal-body mt-0 p-0">
                              <div class="embed-responsive embed-responsive-4by3">
                                  <!--<iframe class="embed-responsive-item" id="youtube" :src="'https://www.youtube.com/embed/'+tema.video_url+'?controls=0&fs=0&rel=0&showinfo=0&color=white'" allowfullscreen></iframe>-->
                                  <iframe
                                          class="embed-responsive-item"
                                          id="youtube"
                                          frameborder="0"
                                          allowfullscreen
                                          src=''></iframe>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</template>

<script>

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
                        type: 'pattern'
                    },
                    {
                        id: 2,
                        name: 'kanji',
                        type: 'pattern'
                    },
                    {
                        id: 3,
                        name: 'pattern',
                        url:'/imagenes/path/pattern-marker.patt',
                        type: 'pattern'
                    }
                ],

                nextRotationEvent: "rotation-start",
                // Orientation du marker par défaut.
                isMarkerHorizontal: true,
                // Indicateur de support de la détection d'orientation.
                hasDeviceOrientationEvent: false,
                // Détection automatique de l'orientation.
                isDeviceOrientationDetection: true,
                // Orientation de l'appareil au moment de la suppression de détection automatique.
                isDeviceOrientationHorizontal: true,
                // Orientation de l'appareil (Portrait vs Paysage).
                isPortraitMode: true,
                // Angle limite de la position de l'appareil pour détecter une observation de marker horizontal ou vertical.
                ANGLE: 45,

                // objetoV: '',
            }
        },
        methods:{

            mostrar: function(tema){
                var id = tema.video_url;
                // console.log(id);
                var autoplay = '?autoplay=1';
                var related_no = '&rel=0';

                var src = 'https://www.youtube.com/embed/'+id+autoplay+related_no;
                // console.log(src);
                $('#youtube').attr('src', src);
            },

            NextModel: function(inc, tema){
                var modelCount = tema.bd_objeto.length;
                var modelNbr =  Math.floor(Math.random() * modelCount);

                modelNbr = (modelNbr + inc) % tema.bd_objeto.length;
                modelNbr = modelNbr < 0 ? tema.bd_objeto.length + modelNbr : modelNbr;
                console.log(">>> Model " + tema.bd_objeto[modelNbr].src.split("/")[1] + " (" + (modelNbr + 1) + "/" + tema.bd_objeto.length + ") loading...");

                // document.getElementById("error").style.display = "none";
                // document.getElementById("loader").style.display = "none";
                this.RotationStop();

                for (var i=0; i < document.getElementsByName("model").length; i++){
                    // document.getElementsByName("model")[i].setAttribute("animation__scale", "to", null);
                    // document.getElementsByName("model")[i].setAttribute("animation__position", "to", null);

                    switch (tema.bd_objeto[modelNbr].format){
                        case "gltf":
                            document.getElementById("gltf1").setAttribute('src', '/storage/' + tema.bd_objeto[modelNbr].src);
                            document.getElementsByName("model")[i].setAttribute("gltf-model", "#gltf1");
                            document.getElementsByName("model")[i].removeAttribute("obj-model");
                            break;
                        case "obj":
                            document.getElementById("obj1").setAttribute('src', '/storage/' + tema.bd_objeto[modelNbr].src);
                            document.getElementById("mtl1").setAttribute('src', '/storage/' + tema.bd_objeto[modelNbr].material);
                            document.getElementsByName("model")[i].setAttribute("obj-model",  "obj: #obj1; mtl: #mtl1");
                            document.getElementsByName("model")[i].removeAttribute("gltf-model");
                            break;
                        default:
                            console.log(">>> Format\"" + tema.bd_objeto[modelNbr].format + "\" unknown!");
                    }
                    document.getElementsByName("model")[i].setAttribute("scale", tema.bd_objeto[modelNbr].scale);
                    document.getElementsByName("model")[i].setAttribute("position", this.isMarkerHorizontal ? tema.bd_objeto[modelNbr].positionH : tema.bd_objeto[modelNbr].positionV);
                    document.getElementsByName("model")[i].setAttribute("rotation", this.isMarkerHorizontal ? tema.bd_objeto[modelNbr].rotationH : tema.bd_objeto[modelNbr].rotationV);
                }
            },

            RotationStop: function(){
                // console.log(">>> Stop rotation");
                var rotateBtn = $(".rotate-obj");
                // this.nextRotationEvent = "rotation-restart";
                for (var i = 0; i < document.getElementsByName("rotation").length; i++){
                    rotateBtn.removeClass("rotate_fade");
                    document.getElementsByName("rotation")[i].emit("rotation-pause");
                    document.getElementsByName("rotation")[i].setAttribute("rotation", "0 0 0");
                }
            },

            RotationOnOff: function(){
                console.log(">>> " + (this.nextRotationEvent === "rotation-pause" ? "Pause" : "Play") + " rotation");
                var rotateBtn = $(".rotate-obj");
                for (var i = 0; i < document.getElementsByName("rotation").length; i++) {
                    rotateBtn.addClass("rotate_fade");
                    if (this.isMarkerHorizontal) {
                        document.getElementsByName("rotation")[i].setAttribute("animation", "to", "0 360 0");
                    } else {
                        document.getElementsByName("rotation")[i].setAttribute("animation", "to", "0 0 360");
                    }
                    document.getElementsByName("rotation")[i].emit(this.nextRotationEvent);
                }
                switch (this.nextRotationEvent) {
                    case "rotation-start":
                    case "rotation-restart":
                    case "rotation-resume":
                        this.nextRotationEvent = "rotation-pause";
                        rotateBtn.addClass("rotate_fade");
                        break;
                    case "rotation-pause":
                        this.nextRotationEvent = "rotation-resume";
                        rotateBtn.removeClass("rotate_fade");
                        break;
                    default:
                        console.log(">>> Event \"" + this.nextRotationEvent + "\" unknown !");
                }
            },

            Zoom: function(tema, sign) {
                var modelCount = tema.bd_objeto.length;
                var modelNbr = Math.floor(Math.random() * modelCount);
                console.log(">>> Zoom" + (0 < sign ? "in" : "out"));

                for (var i = 0; i < document.getElementsByName("model").length; i++) {
                    var oScale = document.getElementsByName("model")[i].getAttribute("scale");
                    if ((sign < 0 && 0.0001 < oScale.x - tema.bd_objeto[modelNbr].scaleInc) || 0 < sign) {	// Floating point problem.
                        var factor = 1 + sign * tema.bd_objeto[modelNbr].scaleInc / oScale.x;
                        var oPosition = document.getElementsByName("model")[i].getAttribute("position");
                        var sPosition =   oPosition.x * factor + " "
                            + oPosition.y * factor + " "
                            + oPosition.z * factor;
                        document.getElementsByName("model")[i].setAttribute("animation__position", "to", sPosition);

                        var sScale =  (parseFloat(oScale.x) + sign * tema.bd_objeto[modelNbr].scaleInc) + " "
                            + (parseFloat(oScale.y) + sign * tema.bd_objeto[modelNbr].scaleInc) + " "
                            + (parseFloat(oScale.z) + sign * tema.bd_objeto[modelNbr].scaleInc);
                        document.getElementsByName("model")[i].setAttribute("animation__scale", "to", sScale);
                        document.getElementsByName("model")[i].emit("zoom-start");
                    }
                }

            },

            PrintOrientation(beta, gamma) {
                var orientationAngle;
                if (this.isPortraitMode) {
                    orientationAngle = (beta  ? Math.round(beta)  : "");
                } else {
                    orientationAngle = (gamma ? Math.round(gamma) : "");
                }
                document.getElementById("marker-detection").textContent = (this.isDeviceOrientationDetection ? orientationAngle + "°" : "");

                document.getElementById("marker-orientation").src = "/imagenes/" + (this.isMarkerHorizontal ? "orientation_horizontal.png" : "orientation_vertical.png");
            },

            SwitchDetection() {
                this.isDeviceOrientationDetection = !this.isDeviceOrientationDetection;
                console.log(">>> Switch to " + (this.isDeviceOrientationDetection ? "automatic detection of" : "forced") + " marker orientation");
                this.PrintOrientation(false, false);
            },

            SwitchOrientation(beta, gamma, tema) {
                var modelCount = tema.bd_objeto.length;
                console.log('Soy Yo: ' + modelCount);
                var modelNbr = Math.floor(Math.random() * modelCount);
                this.RotationStop();
                this.isMarkerHorizontal = !this.isMarkerHorizontal;
                console.log(">>> Switch to " + (this.isMarkerHorizontal ? "horizontal" : "vertical") + " marker");
                this.PrintOrientation(beta, gamma);
                for (var i = 0; i < document.getElementsByName("model").length; i++) {
                    document.getElementsByName("model")[i].setAttribute("position", this.isMarkerHorizontal ? tema.bd_objeto[modelNbr].positionH : tema.bd_objeto[modelNbr].positionV);
                    document.getElementsByName("model")[i].setAttribute("rotation", this.isMarkerHorizontal ? tema.bd_objeto[modelNbr].rotationH : tema.bd_objeto[modelNbr].rotationV);
                }
            },

            CycleOrientation: function(tema){
                if (this.isDeviceOrientationDetection) {
                    this.SwitchDetection();
                    this.isDeviceOrientationHorizontal = this.isMarkerHorizontal;
                } else {
                    if (this.isMarkerHorizontal === this.isDeviceOrientationHorizontal || !this.hasDeviceOrientationEvent) {
                        this.SwitchOrientation(false, false, tema)
                    } else {
                        this.SwitchDetection();
                    }
                }
            }

        },
        mounted() {
            var app =this;

            // MODAL VIDEO
            $("#myVideo").on("hidden.bs.modal", function () {
                $("#youtube").attr("src", '');
            });
            $('#myVideo').on("show.bs.modal", function () {
            })

            var modelCount = this.tema.bd_objeto.length;
            var modelNbr = Math.floor(Math.random() * modelCount);

            if (modelCount === 1){
                document.getElementById("leftArrow").style.display = "none";
                document.getElementById("rightArrow").style.display = "none";
            };

            document.getElementsByName("model")[0].addEventListener("loader", () => {
                console.log(">>> Model " + this.tema.bd_objeto[modelNbr].src.split("/")[1] + " (" + (modelNbr + 1) + "/" + this.tema.bd_objeto.length + ") loaded");
                document.getElementById("loader").style.display = "none";
                for (var i = 0; i < document.getElementsByName("model").length; i++) {
                    // Soft display.
                    document.getElementsByName("model")[i].emit("fadein");
                }
            });

            document.getElementsByName("model")[0].addEventListener("error", () => {
                console.log(">>> Model " + this.tema.bd_objeto[modelNbr].src.split("/")[1] + " (" + (modelNbr + 1) + "/" + this.tema.bd_objeto.length + ") error");
                document.getElementById("loader").style.display = "none";
                document.getElementById("error" ).style.display = "inline";
            });

            app.NextModel(0, this.tema);
            // app.NextModel(tema, 0);

            $('.video-info').tooltip({
                'show':true,
                'placement': 'right',
                'title': 'Video del Tema'
            });
            $('.return-tema').tooltip({
                'show':true,
                'placement': 'right',
                'title': 'Regresar a Temas'
            });
            // console.clear();

            /*** Código de Orientación... ***/

            window.addEventListener("deviceorientation", (event) => {
                // Détection du support "réel" de l'évènement d'orientation de l'appareil.
                if (event.alpha !== null && event.beta !== null && event.gamma !== null) {
                    app.hasDeviceOrientationEvent = true;
                } else {
                    app.hasDeviceOrientationEvent = false;
                    app.isDeviceOrientationDetection = false;
                    app.PrintOrientation(false, false);
                }

                // Screen Orientation non supporté par Safari : https://caniuse.com/#feat=screen-orientation
                // => Alternative : https://davidwalsh.name/orientation-change
                app.isPortraitMode = (window.matchMedia("(orientation: portrait)").matches ? true : false);
                // Si on est en mode détection automatique et que la position de l'appareil n'est pas en accord avec la position du marker, alors on switch.
                if (app.hasDeviceOrientationEvent && app.isDeviceOrientationDetection) {
                    var toSwitch = false;
                    if (app.isPortraitMode) {
                        if (app.isMarkerHorizontal) {
                            if (event.beta < -app.ANGLE || app.ANGLE < event.beta) {
                                toSwitch = true;
                            }
                        } else {
                            if (-app.ANGLE < event.beta && event.beta < app.ANGLE) {
                                toSwitch = true;
                            }
                        }
                    } else {
                        if (app.isMarkerHorizontal) {
                            if (event.gamma < -app.ANGLE || app.ANGLE < event.gamma) {
                                toSwitch = true;
                            }
                        } else {
                            if 	(-app.ANGLE < event.gamma && event.gamma < app.ANGLE) {
                                toSwitch = true;
                            }
                        }
                    }
                    if (toSwitch) {
                        app.SwitchOrientation(event.beta, event.gamma, this.tema);
                    }
                    app.PrintOrientation(event.beta, event.gamma);
                }
            });
            // Affichage de la position par défaut du marker.
            app.PrintOrientation(false, false);

            // AFRAME.registerComponent('ejemplo', {
            //     init: function () {
            //
            //         var entityEL = document.querySelector('#crea_obj'), gltfModel = document.querySelector('#crea_gltf') ,
            //             scaleBtn = $(".zoom-plus"), menusScale = $(".zoom-menus"), rotateBtn = $(".rotate-obj");
            //
            //         rotateBtn.click(function () {
            //             if (rotateBtn.hasClass("rotate_fade")){
            //                 gtlfModel.emit('endRotate');
            //                 entityEL.emit('endRotate');
            //                 rotateBtn.removeClass("rotate_fade");
            //             }else {
            //                 gtlfModel.emit('rotate');
            //                 entityEL.emit('rotate');
            //                 rotateBtn.addClass("rotate_fade");
            //             }
            //         });
            //
            //         var scaleFlag = 0;
            //
            //         scaleBtn.click(function () {
            //             if (scaleFlag === 0){
            //                 scaleFlag = 1;
            //                 entityEL.object3D.scale.set(1.5, 1.5, 1.5);
            //                 gltfModel.object3D.scale.set(1.5, 1.5, 1.5);
            //                 // scaleBtn.addClass("scale_one");
            //             }else if (scaleFlag === 1){
            //                 scaleFlag = 2;
            //                 entityEL.object3D.scale.set(2, 2, 2);
            //                 gltfModel.object3D.scale.set(2, 2, 2);
            //                 // scaleBtn.addClass("scale_two");
            //                 // scaleBtn.removeClass("scale_one");
            //             }else if (scaleFlag === 2){
            //                 scaleFlag = 3;
            //                 entityEL.object3D.scale.set(2.5, 2.5, 2.5);
            //                 gltfModel.object3D.scale.set(2.5, 2.5, 2.5);
            //                 // scaleBtn.removeClass("scale_two");
            //             }else if (scaleFlag === 3){
            //                 scaleFlag = 4;
            //                 entityEL.object3D.scale.set(3, 3, 3);
            //                 gltfModel.object3D.scale.set(3, 3, 3);
            //                 // scaleBtn.removeClass("scale_two");
            //             }
            //         });
            //
            //         menusScale.click(function () {
            //             if (scaleFlag === 4){
            //                 scaleFlag = 3;
            //                 entityEL.object3D.scale.set(2.5, 2.5, 2.5);
            //                 gltfModel.object3D.scale.set(2.5, 2.5, 2.5);
            //             }else if (scaleFlag === 3){
            //                 scaleFlag = 2;
            //                 entityEL.object3D.scale.set(2, 2, 2);
            //                 gltfModel.object3D.scale.set(2, 2, 2);
            //             }else if (scaleFlag === 2){
            //                 scaleFlag = 1;
            //                 entityEL.object3D.scale.set(1.5, 1.5, 1.5);
            //                 gltfModel.object3D.scale.set(1.5, 1.5, 1.5);
            //             }else if (scaleFlag === 1){
            //                 scaleFlag = 0;
            //                 entityEL.object3D.scale.set(1, 1, 1);
            //                 gltfModel.object3D.scale.set(1, 1, 1);
            //             }
            //         });
            //
            //         // var groupObject3D = gltfModel.object3D;
            //         //
            //         // console.log(groupObject3D)
            //         // console.log(this.sceneEl);
            //     },
            //
            //
            //     // schema: { type: 'vec3' },
            //     //
            //     // update: function () {
            //     //     this.el.object3D.position.set(
            //     //       this.data.x,
            //     //       this.data.y,
            //     //       this.data.z
            //     //     );
            //     // }
            //
            // });



            // var gtlfModel = document.querySelector('#crea_gltf'),
            //     objModel = document.querySelector('#crea_obj'),
            //     rotateBtn = $(".rotate-obj"),
            //     scaleBtn = $(".zoom-plus"),
            //     switchBtn = $(".arrow_right"),
            //     gotitBtn = $(".gotit");



            document.getElementById("loader").style.display = "none";
            document.getElementById("error").style.display = "none";
        }

    }
</script>

<style scoped>

</style>