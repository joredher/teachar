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
                                <td><span v-text="tema.estado"></span></td>
                                <td><span v-text="tema.fecha"></span></td>
                                <td><button class="btn btn-sm btn-info " @click="mostrarEditar(tema)" data-toggle="modal" data-target="#myModal">Editar</button></td>
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
                tema :{},
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
                    laddaButtonSearch.stop();
                    this.temas = data;
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
                    var app = this;
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            laddaButton.start();
                            this.$http.post('/administracion/configuracion/guardar-tema',this.tema).then((response)=>{
                                laddaButton.stop();
                                if(response.body.estado=='ok'){
                                    if(response.body.tipo == 'update'){
                                        var index = this.temas.indexOf(this.temaEnEdicion);
                                        toastr["success"]('Tema actualizado correctamente.');
                                    }else{
                                        // this.docentes.push(response.body.docentes.length.id);
                                        this.tema.id = response.body.id;
                                        toastr["success"]('Tema creado correctamente.');
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

                mostrarEditar: function (tema) {
                    this.temaEnEdicion = tema;
                    this.tema = JSON.parse(JSON.stringify(tema));
                    this.tema.estado = (this.tema.estado == 'Activo')?1:0;
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
                    app.modal.title = (app.tema.id != ''?'Edición de ':'Nuevo ') + 'Tema';
                    app.complementosTemas();
                });
            }
        })
    </script>
@endsection