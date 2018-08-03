<template>
    <div>
        <vue-scrollbar classes="my-scrollbar" ref="Scrollbar">
            <div class="otroScroll2">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 pt-sm-0 pt-md-3 pt-lg-3 pt-xl-3 pb-5 zoomIn animated" v-for="modulo in modulos">
                        <div class="contentCard">
                            <a class="card styCard">
                                <div class="card-front" :class="{ desactivado: desactivado(modulo)}" :style="{ 'background-image': 'url('+ imagen(modulo) + ')' }">
                                    <h4 class="text-white position-absolute p-2" v-text="modulo.nombre"></h4>
                                </div>
                                <div class="card-back otroScroll">
                                    <div class="content-back text-center">
                                        <div class="d-block contentModulo" :class="{ desactivado: desactivado(modulo)}">
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
        </vue-scrollbar>
    </div>
</template>
<script>
    import VueScrollbar from 'vue2-scrollbar';
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
       components: {
           VueScrollbar
       },
       created(){
           // console.clear();
        },
       methods:{
           imagen(modulo){
             return  this.urlModu + modulo.foto ;
           },

           desactivado(modulo){
               return modulo.estado === 'Inactivo';
           },

           someMethod() {
               this.$refs.Scrollbar.scrollToY(100)
           }
       },
       mounted(){
       }
    };
</script>

<style scoped>
    .my-scrollbar{
        width: 100% !important;
        min-width: 300px;
        max-height: 450px;
    }

    /*The Content*/
    .scroll-me{
        min-width: 750px;
    }
</style>