@extends('layouts.dashboard')

@section('modulo-url', '#')
@section('modulo-nombre', 'Módulos')

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
        /*** Upload Image ***/

        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        #img-upload{
            width: 50%;
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
                            <tr v-for="(modulo, index) in modulos" >
                                <td><span v-text="index + 1"></span></td>
                                <td><span v-text="modulo.nombre"></span></td>
                                <td><span v-text="modulo.estado"></span></td>
                                <td><span v-text="modulo.fecha"></span></td>
                                <td class="row mr-auto text-center pl-4">
                                    <div class="col-xs-1 pr-1">
                                        <button class="btn btn-sm btn-info " @click.prevent="mostrarEditar(modulo, index)" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="col-xs-1 pl-1">
                                        <button class="btn btn-sm btn-outline-secondary" @click.prevent="eliminarDato(modulo, index)"><i class="fas fa-trash-alt" ></i></button>
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
        @include('administracion.configuracion.modulos.modal.form_create')
    </section>
@endsection

@section('scripts')
    @include('helpers.switch')
    @include('helpers.vcropp')
    <script>

        var app = new Vue({
            el: '#contenido',
            data : {
                modulos :[],
                resource_url : '/administracion/configuracion/obtener-modulos',
                datos : {
                    busqueda :''
                },
                modulo :{},
                modal:{
                    title:'',
                },
                moduloEnEdicion : '',
                cargando : false,
            },

            components:{
                VPaginator: VuePaginator
            },

            methods:{
                updateResource:function (data) {
                    laddaButtonSearch.stop();
                    this.modulos = data;
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

                start(){
                    toastr.warning('¡La imagen no debe ser tan pesada!.');
                    toastr.info('¡Recomendable subir imagenes tipo .png, .jpg o jpeg!');
                },

                formReset : function () {
                    this.modulo ={
                        id: '',
                        nombre: '',
                        descripcion:'',
                        foto:'',
                        estado: 1,
                        fecha:'',
                    };
                    if(this.$refs.vcropp){
                      this.$refs.vcropp.destroy();
                    }
                },

                guardar : function () {
                    var app = this;
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            laddaButton.start();
                            this.modulo.foto = this.$refs.vcropp.getImage();
                            this.$http.post('/administracion/configuracion/guardar-modulo',this.modulo).then((response)=>{
                                laddaButton.stop();
                                if(response.body.estado=='ok'){
                                    if(response.body.tipo == 'update'){
                                        var index = this.modulos.indexOf(this.moduloEnEdicion);
                                        toastr["success"]('Módulo actualizado correctamente.');
                                    }else{
                                        this.modulo.id = response.body.id;
                                        toastr["success"]('Módulo creado correctamente.');
                                    }
                                    app.$refs.vpaginator.fetchData(this.resource_url);
                                    $('#myModal').modal('hide');
                                    $('#input-foto').val('')
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
                            $('.nav-tabs-modulo').find('li:nth-child('+(($('.form-control[data-vv-name$="'+error.field+'"]').closest(".tab-pane").index())+1)+')').find('a').click();
                            $('.form-control[data-vv-name$="'+error.field+'"]').focus();
                        }else{
                            $('.nav-tabs-modulo').find('li:nth-child('+(($('.dropdown[data-vv-name$="'+error.field+'"]').closest(".tab-pane").index())+1)+')').find('a').click();
                            $('.dropdown[data-vv-name$="'+error.field+'"]').find('.form-control').focus();
                        }
                        toastr.warning(error.field.toUpperCase()+": "+error.msg);
                    });
                },

                mostrarEditar: function (modulo, index) {
                    this.moduloEnEdicion = modulo;
                    this.modulo = JSON.parse(JSON.stringify(modulo));
                    this.modulo.estado = (this.modulo.estado == 'Activo')?1:0;
                },

                eliminarDato(modulo, index){
                    var vue = this;
                    var params ={
                        'id': vue.modulos[index].id,
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    };

                    this.$http.post('/administracion/configuracion/eliminar-modulo', params).then((response)=>{
                        if (response.body.estado=='ok'){
                            if(response.body.tipo=='delete')
                                vue.modulos.splice(modulo,1);
                            toastr.info(' Módulo  eliminado ');
                        }
                        vue.$refs.vpaginator.fetchData(this.resource_url);
                    })

                },


            },
            beforeMount(){
                this.formReset();
            },
            mounted(){
                console.clear();
                var app = this;
                $("#myModal").on("hidden.bs.modal", function () {
                    app.formReset();
                });

                $("#myModal").on("shown.bs.modal", function () {
                    app.modal.title = (app.modulo.id != ''?'Edición de ':'Nuevo ') + 'Módulo';
                    $('.nav-tabs-modulo').find('li:nth-child(1)').find('a').click();
                });
            },
            created() {
                this.start();
            }
        })
    </script>
@endsection