<template>
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 pb-5" v-for="modulo in modulos">
                <div class="contentCard zoomIn animated">
                    <a class="card styCard">
                        <div class="card-front" :style="{ 'background-image': 'url(' + modulo.foto + ')' }">
                            <h4 class="" v-text="modulo.nombre"></h4>
                        </div>
                        <div class="card-back">
                            <div class="content-back d-inline-block text-center">
                                <P class="card-text text-justify" v-text="modulo.descripcion"></P>
                                <br/>
                                <p id="modulo"></p>
                                <a :href="'/usuario/modulo/'+modulo.id" class="btn btn_push underline text-light"> Ir </a>
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
                // image: modulo.foto,
            }
        },
       methods:{
           color() {
               return this.coloress[Math.floor(Math.random() * this.coloress.length)];
           },

       },
       mounted(){
            // $('.styCard').on('click', function () {
            //     $(this).toggleClass('flipped');
            // });
       }
    };
</script>