@extends('layouts.dashboard')

@section('estilos')
    <style type="text/css">
        .form-control:focus{
            outline: none;
            background-color: #fff;
            border-color: #CED4DA;
            box-shadow: none;
        }

        .btn:focus{
            outline: none;
            box-shadow: none;
        }

        .btn{
            cursor: pointer;
        }
    </style>
@endsection

@section('contenido')
    <section id="contenido">
        <div class="card">
            <div class="card-header pb-3">
               @include('helpers.filtro')
            </div>
            <div class="card-body">
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-info bg-light">
                            <tr>
                                <th class="text-left">Identificación</th>
                                <th class="text-left">Nombre Completo</th>
                                <th class="text-left">Username</th>
                                <th class="text-left">Estado</th>
                                <th class="text-left">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(docente, index) in docentes">
                                <td class="text-left"><span class="text-right" v-text="docente.identification"></span></td>
                                <td class="text-left"><span v-text="docente.name +' '+ docente.last_name"></span></td>
                                <td class="text-left"><span v-text="docente.username"></span></td>
                                <td class="text-left"><span v-text="docente.state"></span></td>
                                <td class="row mr-auto text-center pl-4">
                                    <div class="col-xs-1 pr-1">
                                        <button class="btn btn-sm btn-info " @click="mostrarEditar(docente, index)" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="col-xs-1 pl-1">
                                        <button class="btn btn-sm btn-outline-secondary" @click.prevent="eliminarDato(docente, index)"><i class="fas fa-trash-alt" ></i></button>
                                    </div>
                                </td>

                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <v-paginator ref="vpaginator" :resource_url="resource_url" @update="updateResource" :datos="datos"></v-paginator>
            </div>
        </div>
        @include('administracion.configuracion.docentes.modal.form_create')
    </section>
@endsection

@section('scripts')
    @include('helpers.switch')
    <script>
        var app = new Vue({
            el: '#contenido',
            data : {
                docentes:[],
                resource_url : '/administracion/configuracion/obtener-docentes',
                datos : {
                    busqueda :''
                },
                docente :{},
                modal:{
                    title:'',
                },
                docenteEnEdicion : '',
                // cargando : false,
            },

            components:{
                VPaginator: VuePaginator
            },

            methods:{
                updateResource:function (data) {
                    laddaButtonSearch.stop();
                    this.docentes = data;
                },

                buscar(){
                    laddaButtonSearch.start();
                    this.$refs.vpaginator.fetchData(this.resource_url)
                },

                limpiar(){
                    this.datos.busqueda = '';
                    laddaButtonSearch.start();
                    this.$refs.vpaginator.fetchData(this.resource_url);
                },

                formReset : function () {
                    this.docente ={
                        id:'',
                        identification:'',
                        name:'',
                        last_name:'',
                        username:'',
                        email:'',
                        password: '',
                        state:'',

                    }
                },

                guardar : function () {
                    var app = this;
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            laddaButton.start();
                            this.$http.post('/administracion/configuracion/guardar-docente',this.docente).then((response)=>{
                                laddaButton.stop();
                                if(response.body.estado=='ok'){
                                    if(response.body.tipo == 'update'){
                                        var index = this.docentes.indexOf(this.docenteEnEdicion);
                                        toastr["success"]('Docente actualizado correctamente.');
                                    }else{
                                        // this.docentes.push(response.body.docentes.length.id);
                                        this.docente.id = response.body.id;
                                        toastr["success"]('Docente creado correctamente.');
                                    }
                                    app.$refs.vpaginator.fetchData(this.resource_url);
                                    $('#myModal').modal('hide');
                                }else if(response.body.estado == 'validador'){
                                    errores = response.body.errors;
                                    jQuery.each(errores,function (i,value) {
                                        toastr.warning( i.toUpperCase()+": "+value)
                                    })
                                }else{
                                    toastr.warning(response.body.error)
                                }
                            },(error)=>{
                                laddaButton.stop();
                                toastr.error('Error al hacer algo:: '+error.status + ' '+error.statusText+' ('+error.url+')');
                            });
                            return;
                        }
                        var error = app.errors.items[0];
                        if($('.form-control[data-vv-name$="'+error.field+'"]').hasClass('form-control')){
                            $('.nav-tabs').find('li:nth-child('+(($('.form-control[data-vv-name$="'+error.field+'"]').closest(".tab-pane").index())+1)+')').find('a').click();
                            $('.form-control[data-vv-name$="'+error.field+'"]').focus();
                        }else{
                            $('.nav-tabs').find('li:nth-child('+(($('.dropdown[data-vv-name$="'+error.field+'"]').closest(".tab-pane").index())+1)+')').find('a').click();
                            $('.dropdown[data-vv-name$="'+error.field+'"]').find('.form-control').focus();
                        }
                        toastr.warning(error.field.toUpperCase()+": "+error.msg);
                    });
                },

                mostrarEditar: function (docente, index) {
                    this.docenteEnEdicion = docente;
                    this.docente = JSON.parse(JSON.stringify(docente));
                    this.docente.state = (this.docente.state=='Activo')?1:0;

                },

                eliminarDato(docente, index){
                    var vue = this;
                    var params ={
                        'id': vue.docentes[index].id,
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    };

                    this.$http.post('/administracion/configuracion/eliminar-docente', params).then((response)=>{
                        if (response.body.estado=='ok'){
                            if(response.body.tipo=='delete')
                                vue.docentes.splice(docente,1);
                                toastr.info('Docente eliminado ');
                            }
                            vue.$refs.vpaginator.fetchData(this.resource_url);
                        })

                },


            },
            beforeMount(){
              this.formReset();
            },
            mounted(){
                var app = this;
                $("#myModal").on("hidden.bs.modal", function () {
                    app.formReset();
                });

                $("#myModal").on("show.bs.modal", function () {
                    app.modal.title = (app.docente.id != ''?'Edición de ':'Nuevo ') + 'Docente';
                });

            }
        });
    </script>
@endsection