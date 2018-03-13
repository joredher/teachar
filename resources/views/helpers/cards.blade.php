<script type="text/x-template" id="cards">
    <div class="card" v-if="value">
        <div class="card-body">
            <div class="card-block clearfix">

            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</script>
<script>
    Vue.component('cards', {
        template: '#cards',
        props:['value'],
        data: function () {
            return {
            }
        },
        watch: {
            value: function() {
                console.log('value in card');
                console.log(this.value);
            }
        },
        methods:{
        },
        mounted(){
        }
    });
</script>