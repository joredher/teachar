<template>
    <div class="container">
        <div class="card cardStep">
            <div class="card-body">
                <form-wizard @on-complete="onComplete"
                             shape="tab"
                             color="#39B3DF">
                    <h2 class="text-info" slot="title">Bienvenido a TeachAR</h2>
                    <tab-content title="Información"
                                 icon="far fa-file-alt">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-justify">
                                    <h4 class="card-title">
                                        ¡Hola <strong v-text="user.name"></strong>!
                                    </h4>
                                    <p class="card-text">
                                        El objeto primordial de esta aplicación es plasmar el valor de Las TIC en el colegio Liceo Pedagógico San Martín,
                                        complementando mediante la tecnología de la
                                        <a class="underline" target="_blank" href="http://realidadaumentada.info/tecnologia/">
                                            <strong>realidad aumentada</strong>
                                        </a> la percepción e interacción del estudiante con el mundo real.
                                    </p>
                                    <p class="card-text">
                                        A continuación, sigue este corto tutorial donde indicaremos
                                        brevemente como puedes enriquecer la experiencia en el aula.
                                    </p>
                                    <p class="card-text">Att: Jorge Hernández</p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <p class="text-muted">
                                    <i>
                                        <strong>
                                            “La tecnología por sí misma no es transformativa. Es la escuela, la pedagogía, la que es transformativa”
                                        </strong>
                                    </i>
                                </p>
                            </div>
                        </div>
                    </tab-content>
                    <tab-content title="Tecnología"
                                 icon="far fa-play-circle">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 text-justify pb-md-2">
                                <h4 class="card-title text-center">
                                    ¿Qué es la realidad aumentada?
                                </h4>
                                <p class="card-text">
                                    La realidad aumentada consiste en combinar el mundo real con el virtual mediante un proceso
                                    informático, enriqueciendo la experiencia visual y mejorando la calidad de comunicación.
                                </p>
                                <p class="card-text">
                                    En esta tecnología se puede añadir información visual a la realidad, y crear todo tipo de experiencias interactivas.
                                </p>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                <!--<img src="/imagenes/aumentada_info/imagen.jpg" class="img-thumbnail" alt="imagen">-->
                                <div class="text-center">
                                    <div>
                                        <video width="320" height="240"
                                               src="/imagenes/aumentada_info/ra_video.mp4"
                                               poster="/imagenes/aumentada_info/post_video.JPG" controls>
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tab-content>
                    <tab-content title="Aumenta la Experiencia"
                                 icon="fas fa-cube">
                        <div class="row">
                            <div class="col-sm-12 pl-1 pr-1">
                                <h4 class="card-title text-center">
                                    GUÍA
                                </h4>
                                <div class="text-center">
                                    <video width="320" height="240"  src="#" poster="/imagenes/aumentada_info/imagen.jpg" controls loop></video>
                                </div>
                            </div>
                        </div>
                    </tab-content>

                    <template slot="footer" slot-scope="props">
                        <div class=wizard-footer-left>
                            <wizard-button  v-if="props.activeTabIndex > 0 && !props.isLastStep" @click.native="props.prevTab()" :style="props.fillButtonStyle">Anterior</wizard-button>
                        </div>
                        <div class="wizard-footer-right">
                            <wizard-button v-if="!props.isLastStep"
                                           @click.native="props.nextTab()"
                                           class="wizard-footer-right"
                                           :style="props.fillButtonStyle">Siguiente</wizard-button>
                            <wizard-button v-else @click.native="onComplete"
                                           class="wizard-footer-right finish-button"
                                           :style="props.fillButtonStyle">{{props.isLastStep ? 'Finalizar' : 'Siguiente'}}</wizard-button>
                        </div>
                    </template>
                </form-wizard>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "previstas",
        props:['user'],
        data: function () {
          return{
              videoId: 'Zn6ZGeDo3ec',
              last_login_at: ''
          }
        },
        methods:{
            onComplete: function () {
                // alert('Yay. Done!');
                swal(
                    {
                        title: "¡Vamos! " + this.user.name,
                        icon: "success",
                        buttons: false,
                        timer: 2000
                    }).then(timer => {
                    if (timer <= 0) {
                        // window.open("http://localhost:8000/")
                        window.location.href = "/usuario/index"
                    }
                });

            },

            mostrar: function(tema){
                var id = tema.video_url;
                // console.log(id);
                var autoplay = '?autoplay=1';
                var related_no = '&rel=0';

                var src = 'https://www.youtube.com/embed/'+id+autoplay+related_no;
                // console.log(src);
                $('#youtube').attr('src', src);
            },
        }

    }
</script>

<style scoped>

</style>