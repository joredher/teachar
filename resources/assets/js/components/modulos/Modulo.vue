<template>
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 pb-5" v-for="modulo in modulos">
                <div class="contentCard zoomIn animated">
                    <a class="card styCard">
                        <div class="card-front" :class="{ desactivado: desactivado(modulo)}" :style="{ 'background-image': 'url(' + modulo.foto + ')' }">
                            <h4 class="text-white position-absolute p-2" v-text="modulo.nombre"></h4>
                        </div>
                        <div class="card-back">
                            <div class="content-back d-inline-block text-center" :class="{ desactivado: desactivado(modulo)}" >
                                <P v-show="modulo.estado !== 'Inactivo'" class="card-text text-justify" v-text="modulo.descripcion"></P>
                                <br/>
                                <p id="modulo"></p>
                                <a v-show="modulo.estado !== 'Inactivo'" :href="'/usuario/modulo/'+modulo.id+'/'+modulo.nombre" class="btn btn_push underline text-light"> Ir </a>
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
                coloress: ['bg-success', 'bg-dark', 'bg-danger','bg-info'],
                statusMod: this.modulos,
                modu: Math.floor(Math.random() * this.statusMod),
                // colEstado: ['desactivado'],
                // image: modulo.foto,
            }
        },
       methods:{
           // color() {
           //     return this.coloress[Math.floor(Math.random() * this.coloress.length)];
           // },

           desactivado(modulo){

               return modulo.estado === 'Inactivo';

               // console.log(this.statusMod[1]);
               // for(var i=0; i<this.statusMod.length; i++){
               //
               //     if (this.statusMod[i].estado !== 'Activo'){
               //         console.log(this.statusMod[i].estado);
               //         var inactivo = this.colEstado[Math.floor(Math.random() * this.colEstado.length)];
               //
               //         return inactivo;
               //     }
               // }
           }

       },
       mounted(){
           console.clear();
           // $('.styCard').on('click', function () {
            //     $(this).toggleClass('flipped');
            // });
       }
    };
</script>