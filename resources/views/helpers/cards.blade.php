<script type="text/x-template" id="cards-template">
    <div v-for="modulo in modulos" class="card text-center bg-danger">
        <div class="card-body">
            <h4 class="text-white" v-text="modulo.nombre"></h4>
            {{--<h4 class="text-dark" v-text="value.nombre"></h4> v-if="value"--}}
        </div>
    </div>
</script>
<script>
    Vue.component('cards-template', {
        template: '#cards-template',
        props:['value', 'nombre', 'index', 'modulos'],
        data: function () {
            return {
                modulos: []
            }
        },
        created: function () {
          // this.getModulos();
        },
        methods: {
            // getModulos: function () {
            //     var urlModulos = 'get-modulos';
            //     axios.get(urlModulos).then(response => {
            //        this.modulos = response.data
            //     });
            // }
        },
    });
</script>