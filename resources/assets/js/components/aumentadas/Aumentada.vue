<template>
    <div>
        <div>
            <!-- Carga_mode-->
            <img id="loader" src="/imagenes/preloader_ra.gif" alt="loading">
            <img id="error" src="/imagenes/error.png" alt="error">
            <div>
                <a-scene id="scene" ejemplo stats="false" arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;'>
                    <!--vr-mode-ui="enabled: false"-->
                    <a-assets>
                        <a-asset-item  id="obj1" src="" ></a-asset-item>
                        <a-asset-item  id="mtl1" src="" ></a-asset-item>
                        <a-asset-item  id="gltf1" src="" ></a-asset-item>
                        <a-asset-item  id="fbx1" src="" ></a-asset-item>
                        <a-asset-item  id="dae1" src="" ></a-asset-item>
                    </a-assets>

                    <a-marker v-for="marker in markers"
                              :key="marker.id" v-bind:preset="marker.name" v-bind:url='marker.url' v-bind:type='marker.type'>
                        <!--<a-entity light="type: hemisphere; color: #fefddd; groundColor: #fefddd; intensity: 1.2"></a-entity>-->
                        <!--<a-entity light="type: hemisphere; color: #fefddd; groundColor: #fff; intensity: 0.5"></a-entity>-->

                        <a-entity
                                name="rotation"
                                animation="
                                property:rotation;
                                dir:alternate;
                                easing: easeInOutSine;
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
                                    dur: 500;
                                    startEvents: zoom-start;"
                                    animation__scale="
                                    property: scale;
                                    easing: easeInOutBack;
                                    dur: 500;
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
                    </a-marker>

                    <a-entity camera></a-entity>
                </a-scene>
            </div>
            <div id="front" class="bounceIn">
                <a  class="return-tema btn btn_push bg-warning btn-warning border-bottom " :href="'/usuario/modulo/' + tema.bd_modulo.slug">
                    <i class="fas fa-caret-left fa-w-16 fa-3x"></i>
                    <i class="icon-shadow fas fa-caret-left fa-w-16 fa-3x"></i>
                </a>
                <a  class="video-info btn btn_push" :data-toggle="tema.bd_objeto.length ? 'modal' : null" data-target="#myVideo"  @click.prevent="tema.bd_objeto.length ? mostrar(tema) : null" >
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
                    },
                    {
                        id: 4,
                        name: 'pattern',
                        url:'/imagenes/triangulo/path/pattern-marker.patt',
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

                modelCount: null,
                modelNbr: null,
                valueName: null,
                valueRotation: null
            }
        },
        beforeMount () {
          this.modelCount = this.tema.bd_objeto.length;
          this.modelNbr = Math.floor(Math.random() * this.modelCount);
          this.valueName = document.getElementsByName("model");
          this.valueRotation = document.getElementsByName("rotation");
        },
        mounted() {
            // console.clear();
            var app =this;

            // MODAL VIDEO
            $("#myVideo").on("hidden.bs.modal", function () {
                $("#youtube").attr("src", '');
            });
            $('#myVideo').on("show.bs.modal", function () {
            })

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

            // COD COMPONENETES RA
            if (this.modelCount === 1 || this.modelCount === 0){
                document.getElementById("leftArrow").style.display = "none";
                document.getElementById("rightArrow").style.display = "none";
            };

            app.NextModel(0, this.tema);

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
                const ANGULO = this.ANGLE;
                app.isPortraitMode = (window.matchMedia("(orientation: portrait)").matches ? true : false);
                // Si on est en mode détection automatique et que la position de l'appareil n'est pas en accord avec la position du marker, alors on switch.
                if (app.hasDeviceOrientationEvent && app.isDeviceOrientationDetection) {
                    var toSwitch = false;
                    if (app.isPortraitMode) {
                        if (app.isMarkerHorizontal) {
                            if (event.beta < -ANGULO || ANGULO < event.beta) toSwitch = true;
                        } else {
                            if (-ANGULO < event.beta && event.beta < ANGULO) toSwitch = true;
                        }
                    } else {
                        if (app.isMarkerHorizontal) {
                            if (event.gamma < -ANGULO || ANGULO < event.gamma) toSwitch = true;
                        } else {
                            if 	(-ANGULO < event.gamma && event.gamma < ANGULO) toSwitch = true;
                        }
                    }
                    if (toSwitch) { app.SwitchOrientation(event.beta, event.gamma, this.tema); }
                    app.PrintOrientation(event.beta, event.gamma);
                }
            });
            // Affichage de la position par défaut du marker.
            app.PrintOrientation(false, false);

            // Evento de carga (Loading)
            this.valueName[0].addEventListener("model-loaded", () => {
                console.log(">>> Model " + this.tema.bd_objeto[this.modelNbr].src.split("/")[1] + " (" + (this.modelNbr + 1) + "/" + this.tema.bd_objeto.length + ") loaded");
                document.getElementById("loader").style.display = "none";
                Object.keys(this.valueName).forEach((key) => { this.valueName[key].emit("fadein") });
            });

            this.valueName[0].addEventListener("model-error", () => {
                console.log(">>> Model " + this.tema.bd_objeto[this.modelNbr].src.split("/")[1] + " (" + (this.modelNbr + 1) + "/" + this.tema.bd_objeto.length + ") error");
                document.getElementById("loader").style.display = "none";
                document.getElementById("error" ).style.display = "inline";
            });

            var sceneEl = document.querySelector('a-scene');
            var entity = sceneEl.querySelector('a-entity').object3D;
            console.log('> escene', entity);
            // entity.
        },
        methods:{
            mostrar: function(tema){
                var id = tema.video_url;
                var autoplay = '?autoplay=1';
                var related_no = '&rel=0';

                var src = 'https://www.youtube.com/embed/'+id+autoplay+related_no;
                $('#youtube').attr('src', src);
            },

            NextModel: function(inc, tema){
                if (tema.bd_objeto.length) {
                    document.getElementById("error" ).style.display = "none";
                    document.getElementById("loader").style.display = "inline";

                    this.modelNbr = ((this.modelNbr + inc) % this.modelCount);
                    this.modelNbr = this.modelNbr < 0 ? (tema.bd_objeto.length + this.modelNbr) : this.modelNbr;
                    console.log(">>> Model " + tema.bd_objeto[this.modelNbr].src.split("/")[1] + " (" + (this.modelNbr + 1) + "/" + tema.bd_objeto.length + ") loading...");

                    this.RotationStop();

                    let value = this.valueName;
                    Object.keys(value).forEach((key) => {
                        this.switchObject(value[key], tema.bd_objeto[this.modelNbr]);
                    });
                } else {
                    console.clear();
                    console.log(">>> Next not function by undefined or null.");
                    document.getElementById("error" ).style.display = "inline";
                    document.getElementById("loader").style.display = "none";
                }
            },

            switchObject (valueId, objeto) {
                valueId.setAttribute("animation__scale", "to", null);
                valueId.setAttribute("animation__position", "to", null);

                switch (objeto.format){
                    case "gltf":
                        valueId.removeAttribute("collada-model");
                        valueId.removeAttribute("fbx-model");
                        valueId.removeAttribute("obj-model");
                        document.getElementById("gltf1").setAttribute('src', '/storage/' + objeto.src);
                        valueId.setAttribute("gltf-model", "#gltf1");
                        break;
                    case "obj":
                        valueId.removeAttribute("collada-model");
                        valueId.removeAttribute("fbx-model");
                        valueId.removeAttribute("gltf-model");
                        document.getElementById("obj1").setAttribute('src', '/storage/' + objeto.src);
                        document.getElementById("mtl1").setAttribute('src', '/storage/' + objeto.material);
                        valueId.setAttribute("obj-model",  "obj: #obj1; mtl: #mtl1");
                        break;
                    case "fbx":
                        valueId.removeAttribute("collada-model");
                        valueId.removeAttribute("gltf-model");
                        valueId.removeAttribute("obj-model");
                        document.getElementById("fbx1").setAttribute('src', '/storage/' + objeto.src);
                        valueId.setAttribute("fbx-model", "#fbx1");
                        break;
                    case "dae":
                        valueId.removeAttribute("gltf-model");
                        valueId.removeAttribute("fbx-model");
                        valueId.removeAttribute("obj-model");
                        document.getElementById("dae1").setAttribute('src', '/storage/' + objeto.src);
                        valueId.setAttribute("collada-model", "#dae1");
                        break;
                    default:
                        console.log(">>> Format\"" + objeto.format + "\" unknown!");
                }

                valueId.setAttribute("scale", objeto.scale);
                valueId.setAttribute("position", this.isMarkerHorizontal ? objeto.positionH : objeto.positionV);
                valueId.setAttribute("rotation", this.isMarkerHorizontal ? objeto.rotationH : objeto.rotationV);

            },

            RotationStop: function(){
                console.log(">>> Stop rotation");
                var rotateBtn = $(".rotate-obj");
                // this.nextRotationEvent = "rotation-restart";
                let valueRotate = this.valueRotation;
                Object.keys(valueRotate).forEach((key) => {
                    rotateBtn.removeClass("rotate_fade");
                    valueRotate[key].emit("rotation-pause");
                    valueRotate[key].setAttribute("rotation", "0 0 0");
                });
            },

            RotationOnOff: function(){
                if (this.tema.bd_objeto.length) {
                    console.log(">>> " + (this.nextRotationEvent === "rotation-pause" ? "Pause" : "Play") + " rotation");
                    var rotateBtn = $(".rotate-obj");
                    let valueRotate = this.valueRotation;

                    Object.keys(valueRotate).forEach((key) => {
                        rotateBtn.addClass("rotate_fade");
                        if (this.isMarkerHorizontal) {
                            valueRotate[key].setAttribute("animation", "to", "0 360 0");
                        } else {
                            valueRotate[key].setAttribute("animation", "to", "0 0 360");
                        }
                        valueRotate[key].emit(this.nextRotationEvent);
                    });
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
                } else {
                    console.log(">>> Rotation not function by undefined or null.");
                }
            },

            Zoom: function(tema, sign) {
                if (tema.bd_objeto.length) {
                    console.log(">>> Zoom" + (0 < sign ? "in" : "out"));
                    let valueName = this.valueName
                    Object.keys(valueName).forEach((key) => {
                        var oScale = valueName[key].getAttribute("scale");
                        if ((sign < 0 && 0.0001 < oScale.x - tema.bd_objeto[this.modelNbr].scaleInc) || 0 < sign) {	// Floating point problem.
                            var factor = 1 + sign * tema.bd_objeto[this.modelNbr].scaleInc / oScale.x;
                            var oPosition = valueName[key].getAttribute("position");
                            var sPosition = oPosition.x * factor + " " + oPosition.y * factor + " " + oPosition.z * factor;
                            valueName[key].setAttribute("animation__position", "to", sPosition);

                            var sScale =  (parseFloat(oScale.x) + sign * tema.bd_objeto[this.modelNbr].scaleInc) + " "
                                + (parseFloat(oScale.y) + sign * tema.bd_objeto[this.modelNbr].scaleInc) + " "
                                + (parseFloat(oScale.z) + sign * tema.bd_objeto[this.modelNbr].scaleInc);
                            valueName[key].setAttribute("animation__scale", "to", sScale);
                            valueName[key].emit("zoom-start");
                        }
                    });
                } else {
                    console.log(">>> Zoom not function by undefined or null.");
                }
            },

            PrintOrientation(beta, gamma) {
                var orientationAngle;
                if (this.isPortraitMode) {  orientationAngle = (beta  ? Math.round(beta)  : ""); }
                else { orientationAngle = (gamma ? Math.round(gamma) : ""); }
                document.getElementById("marker-detection").textContent = (this.isDeviceOrientationDetection ? orientationAngle + "°" : "");

                document.getElementById("marker-orientation").src = "/imagenes/" + (this.isMarkerHorizontal ? "orientation_horizontal.png" : "orientation_vertical.png");
            },

            SwitchDetection() {
                this.isDeviceOrientationDetection = !this.isDeviceOrientationDetection;
                console.log(">>> Switch to " + (this.isDeviceOrientationDetection ? "automatic detection of" : "forced") + " marker orientation");
                this.PrintOrientation(false, false);
            },

            SwitchOrientation(beta, gamma, tema) {
                this.RotationStop();
                this.isMarkerHorizontal = !this.isMarkerHorizontal;
                console.log(">>> Switch to " + (this.isMarkerHorizontal ? "horizontal" : "vertical") + " marker");
                this.PrintOrientation(beta, gamma);
                Object.keys(this.valueName).forEach((key) => {
                    this.valueName[key].setAttribute("position", this.isMarkerHorizontal ? tema.bd_objeto[this.modelNbr].positionH : tema.bd_objeto[this.modelNbr].positionV);
                    this.valueName[key].setAttribute("rotation", this.isMarkerHorizontal ? tema.bd_objeto[this.modelNbr].rotationH : tema.bd_objeto[this.modelNbr].rotationV);
                });
            },

            CycleOrientation: function(tema){
                if (tema.bd_objeto.length) {
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
                } else {
                    console.log(">>> Cycle not function by undefined or null.");
                }
            }

        }
    }
</script>

<style scoped>

</style>