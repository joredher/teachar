<script type="text/x-template" id="progressBar">
    <div class="progress">
        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" :style="{ width: getProgress }" >
            @{{ progress < 100 ? getProgress : "Cargado Completo!" }}
        </div>
    </div>
</script>
<script>
    Vue.component('progress-bar', {
        template: '#progressBar',
        props:{
            progress:{
                type: Number,
                default: 0
            }
        },
        computed: {
            getProgress (){
                return Math.round(this.progress) + '%'
            }
        }

    });
</script>