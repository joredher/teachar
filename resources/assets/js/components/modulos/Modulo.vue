<template>
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 pb-5" v-for="modulo in modulos">
                <div class="contentCard zoomIn animated">
                    <a class="card styCard">
                        <div class="card-front" :class="{ desactivado: desactivado(modulo)}" :style="{ 'background-image': 'url('+ imagen(modulo) + ')' }">
                            <h4 class="text-white position-absolute p-2" v-text="modulo.nombre"></h4>
                        </div>
                        <div class="card-back">
                            <div class="content-back text-center">
                                <div class="d-block" :class="{ desactivado: desactivado(modulo)}">
                                    <P v-show="modulo.estado !== 'Inactivo'" class="card-text text-justify" v-text="modulo.descripcion"></P>
                                    <!--<br/>-->
                                    <!--<p id="modulo"></p>-->
                                    <a v-show="modulo.estado !== 'Inactivo'" :href="'/usuario/modulo/'+modulo.slug" class="btn btn_push underline text-light"> Ir </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
   export default {
       name:'modulos',
        props:['modulos'],
        data: function () {
            return {
                statusMod: this.modulos,
                modu: Math.floor(Math.random() * this.statusMod),
                urlModu: '/storage/',
            }
        },
       methods:{
           imagen(modulo){
             return  this.urlModu + modulo.foto ;
           },

           desactivado(modulo){
               return modulo.estado === 'Inactivo';
           }

       },
       mounted(){
           console.clear();
       }
    };
</script>