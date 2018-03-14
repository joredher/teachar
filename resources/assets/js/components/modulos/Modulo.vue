<template>
    <div  class="card text-center bg-danger">
        <div class="card-body">
            <h4 class="text-white"> Hola Mundo</h4>
            <!--{{&#45;&#45;<h4 class="text-dark" v-text="value.nombre"></h4> v-if="value"&#45;&#45; v-for="modulo in modulos"}}-->
        </div>
    </div>
</template>
<script>
   export default {
       name:'modulos',
        props:['modulos'],
        data: function () {
            return {
                modulos: []
            }
        },
    };
</script>