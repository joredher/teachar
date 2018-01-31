<script type="text/x-template" id="switch">
    <fieldset>
        <div :class="classcontent?classcontent:'float-xs-left'">
            <label v-if="type!='bootstrap'">@{{ labeloff }}</label>
            <input type="checkbox" :id="id"/>
            <label v-if="type!='bootstrap'">@{{ labelon }}</label>
        </div>
    </fieldset>
</script>
<script>
    Vue.component('switch-ts', {
        template: '#switch',
        props:['id','value', 'labelon', 'labeloff', 'disabled', 'type','classcontent'],
        data: function () {
            return {
                switchery:null
            }
        },
        watch: {
            value: function() {
                var app = this;
                $('#'+app.id).prop('checked',app.value);
                if(app.type!='bootstrap'){
                    app.switchery.handleOnchange(app.value);
                }
            },
            disabled:function () {
                var app = this;
                $('#'+app.id).prop('checked',false);

                if(app.type=='bootstrap'){
                    $('#'+app.id).prop('disabled',app.disabled);
                }else{
                    app.switchery.handleOnchange(false);
                    if(app.disabled){
                        app.switchery.disable();
                    }else{
                        app.switchery.enable();
                    }
                }
            }
        },
        methods:{
        },
        mounted(){
            var app = this;
            $('#'+app.id).prop('checked',app.value);
            if(app.type=='bootstrap'){
                $('#'+app.id).addClass('switch');
                $('#'+app.id).checkboxpicker({
                    html: true,
                    offLabel:app.labeloff ||'No',
                    onLabel:app.labelon || 'Si',
                });
            }else{
                app.switchery = new Switchery($('#'+app.id)[0]);
            }

            $('#'+app.id).on('change', function(){
                app.$emit('update:value', $(this).is(':checked'))
            });
        }
    });
</script>