<template>
    <div>
        <div class="card-columns">
            <div v-for="modulo in modulos" class="card img-fluid text-light" style="width:500px">
                <img src="https://placeimg.com/640/480/nature" class="card-img-top text-light" alt="img">
                <div class="card-img-overlay">
                    <h4 class="card-title" v-text="modulo.nombre"></h4>
                    <P class="card-text" v-text="modulo.descripcion"></P>
                </div>
            </div>
        </div>
        <!--<div class="card-deck"> :class="color()"-->
        <!--<div class="cards">-->
            <!--<a class="card2" v-for="modulo in modulos"  href="#">-->
			<!--<span class="card2-header" style="background-image: url(http://placeimg.com/400/200/animals);">-->
				<!--<span class="card2-title">-->
					<!--<h3 v-text="modulo.nombre"></h3>-->
				<!--</span>-->
			<!--</span>-->
                <!--<span class="card2-summary" v-text="modulo.descripcion"></span>-->
                <!--<span class="card2-meta">-->
				<!--Published: June 18th, 2015-->
			<!--</span>-->
            <!--</a>-->
        <!--</div>-->
    </div>
</template>
<script>
   export default {
       name:'modulos',
        props:['modulos'],
        data: function () {
            return {
                coloress: ['bg-success', 'bg-dark', 'bg-danger','bg-info'],
            }
        },
       methods:{
           color() {
               return this.coloress[Math.floor(Math.random() * this.coloress.length)];
           }
       }
    };
</script>