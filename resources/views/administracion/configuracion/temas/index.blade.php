@extends('layouts.dashboard')

@section('contenido')
    <section id="contenido">
        <div class="card">
            <div class="card-header pb-3">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-12 float-xs-left">
                        {{--<div class="md-form form-group">--}}
                        {{--<a href="" class="btn btn-primary btn-lg">--}}
                        {{--<i class="icon ion-plus-circled white"></i>Crear--}}
                        {{--</a>--}}
                        {{--</div>--}}
                        <button type="button" class="btn btn-home animate btn-new-1" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-plus" aria-hidden="true"></i>
                            <span>Crear</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card-block card-dashboard">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-info bg-light">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Fecha creacion</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="tema in temas" >
                                <td><span v-text="tema.id"></span></td>
                                <td><span v-text="tema.nombre"></span></td>
                                <td><span v-text="tema.contenido"></span></td>
                                <td><span v-text="tema.fecha"></span></td>
                                <td><button class="btn btn-sm btn-info " v-on:click="mostrarEditar(tema)" >Editar</button></td>
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
        @include('administracion.configuracion.temas.modal.form_create')
    </section>
@endsection

@section('scripts')
    @include('helpers.switch')
    <script>

        var app = new Vue({
            el: '#contenido',
            data : {
                temas :[],
                resource_url : '/administracion/configuracion/obtener-temas',
                modulos:[],
                datos : {
                    busqueda :''
                },
                tema :{
                    id: '',
                    nombre: '',
                    contenido:'',
                    fecha:'',
                    estado: 1,
                    modulo_id: '',
                },
                modal:{
                    title:'',
                },
                temaEnEdicion : '',
                cargando : false,
            },

            components:{
                VPaginator: VuePaginator
            },

            methods:{
                updateResource:function (data) {
                    this.temas = data;
                },

                mostrarEditar: function (tema) {
                    this.temaEnEdicion = tema;
                    this.tema = JSON.parse(JSON.stringify(tema));
                    this.tema.estado = (this.tema.estado == 'Activo');
                    $('#myModal').modal('show');

                },

                formReset : function () {
                    this.tema ={
                        id: '',
                        nombre: '',
                        contenido:'',
                        fecha:'',
                        estado: 1,
                        modulo_id: '',

                    }
                },

                complementosTemas: function () {
                    this.$http.get('/administracion/configuracion/obtener-complemento').then(
                        (response)=> {
                            this.modulos = response.body.modulos;
                        },(error)=>{
                            toastr.error(error.status + ' '+error.statusText+' ('+error.url+')');
                        }
                    );
                },

                guardar : function () {
                    this.cargando = true;
                    this.$http.post('/administracion/configuracion/guardar-tema',this.tema).then((response)=>{
                        this.cargando = false;
                        if (response.body.estado == 'ok'){
                            if (response.body.tipo == 'update'){
                                var index = this.temas.indexOf(this.temaEnEdicion);
                                app.$refs.vpaginator.fetchData(this.resource_url);
                                $('#myModal').modal('hide');
                                this.formReset();
                                toastr.success('Tema Actializado Correctamente');
                            }else {
                                //nuevo
                                this.tema.id = response.body.id;
                                this.formReset();
                                app.$refs.vpaginator.fetchData(this.resource_url);
                                toastr.success('Tema Creado Correctamente');
                                $('#myModal').modal('hide');
                                this.formReset();
                            }
                        }else if (response.body.estado == 'validador'){
                            errores = response.body.errors;
                            jQuery.each(errores,function (i,value) {
                                toastr.warning(i.toUpperCase()+": "+value)
                            })
                        }else{
                            // errores = response.body.error;
                            toastr.warning(response.body.error)
                        }
                    },(error)=>{
                        this.cargando = false;
                        toastr.error('error al hacer algo ::'+ error.status+ '' + error.statusText + '( '+error.url+')');
                    });
                },


            },
            mounted(){
                var app = this;
                $("#myModal").on("hidden.bs.modal", function () {
                    app.formReset();
                });

                $("#myModal").on("show.bs.modal", function () {
                    app.modal.title = (app.tema.id != ''?'Edición de ':'Nuevo ') + 'Tema';
                    app.complementosTemas();
                });
            }
        })
    </script>
@endsection