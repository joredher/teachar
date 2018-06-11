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
                                        complementando mediante la tecnología de la <a class="underline" href="#ra"><strong>realidad aumentada</strong></a> la percepción e interacción del estudiante con el mundo real.
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
                    <tab-content title="¿Cómo funciona?"
                                 icon="far fa-play-circle">
                        <div class="row">
                            <div id="ra" class="col-sm-6 text-justify">
                                <h4  class="card-title">
                                    ¿Qué es la realidad aumentada?
                                </h4>
                                <p class="card-text">
                                    La realidad aumentada consiste en combinar el mundo real con el virtual mediante un proceso
                                    informático, enriqueciendo la experiencia visual y mejorando la calidad de comunicación.
                                </p>
                                <div class="text-center">
                                    <a href="#">
                                        <img src="/imagenes/aumentada_info/imagen.jpg" alt="imagen" class="img-thumbnail">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </tab-content>
                    <tab-content title="Aumenta la Experiencia"
                                 icon="fas fa-cube">
                    </tab-content>

                    <template slot="footer" slot-scope="props">
                        <div class=wizard-footer-left>
                            <wizard-button  v-if="props.activeTabIndex > 0 && !props.isLastStep" @click.native="props.prevTab()" :style="props.fillButtonStyle">Anterior</wizard-button>
                        </div>
                        <div class="wizard-footer-right">
                            <wizard-button v-if="!props.isLastStep"@click.native="props.nextTab()" class="wizard-footer-right" :style="props.fillButtonStyle">Siguiente</wizard-button>

                            <wizard-button v-else @click.native="onComplete" class="wizard-footer-right finish-button" :style="props.fillButtonStyle">{{props.isLastStep ? 'Completado' : 'Siguiente'}}</wizard-button>
                        </div>
                    </template>
                </form-wizard>
                <!--<form-wizard @on-complete="onComplete"-->
                <!--shape="square"-->
                <!--color="#39B3DF"-->
                <!--back-button-text="Anterior"-->
                <!--next-button-text="Siguiente"-->
                <!--finish-button-text="Finalizar" finish="Hola">-->
                <!--<h2 slot="title">This will replace my whole title</h2>-->
                <!--<tab-content title="Personal details"-->
                <!--icon="far fa-file-alt">-->
                <!--</tab-content>-->
                <!--<tab-content title="Additional Info"-->
                <!--icon="fas fa-cube">-->
                <!--</tab-content>-->
                <!--<tab-content title="Last step"-->
                <!--icon="far fa-play-circle">-->
                <!--</tab-content>-->
                <!--</form-wizard>-->
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

          }
        },
        methods:{
            onComplete: function () {
                // alert('Yay. Done!');
                swal("¡Vamos!", {
                    icon: "success",
                    buttons: false,
                    timer: 4000,
                });
            }
        }

    }
</script>

<style scoped>

</style>