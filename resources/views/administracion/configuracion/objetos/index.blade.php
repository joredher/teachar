@extends('layouts.dashboard')

@section('modulo-url', '#')
@section('modulo-nombre', 'Objetos')

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

        #objetos{
            background: #eee;
            padding: 20px;
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 pb-4 pl-1 pr-1" v-for="(objeto, index) in objetos">
                            <div class="conten bounceIn animated">
                                <a class="card sty">
                                    <div class="card-front text-center">
                                        <h4 v-text="objeto.titulo"></h4>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                Creado hace: <span v-text="objeto.time"></span>
                                            </small>
                                        </p>
                                        <hr>
                                        <h5 class="card-title"><span v-text="objeto.bd_tema.nombre"></span></h5>
                                        <p class="card-text">Modelo: <strong v-text="objeto.nombre_modelo"></strong></p>
                                        {{--<p class="card-text">Nombre material: <strong v-text="objeto.nombre_material"></strong></p>--}}
                                        <hr>
                                        <div>
                                            <button class="btn btn-sm btn-info " disabled @click.prevent="mostrarEditar(objeto, index)" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-outline-secondary" @click.prevent="eliminarDato(objeto, index)"><i class="fas fa-trash-alt" ></i></button>
                                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer ">
                <v-paginator ref="vpaginator" :resource_url="resource_url" @update="updateResource" :datos="datos"></v-paginator>
            </div>
        </div>
        @include('administracion.configuracion.objetos.modal.form_create')
    </section>
@endsection

@section('scripts')
    @include('helpers.FileInput')
    <script>
        var app = new Vue({
            el: '#contenido',
            data : {
                objetos:[],
                resource_url : '/administracion/configuracion/obtener-objeto',
                temas:[],
                datos : {
                    busqueda :''
                },
                objeto :{},
                modal:{
                    title:'',
                },
                files:[],
                // file:{},
                // form: new FormData,
                // files:[],
                titulo:'',
                tema_id:'',
                objetoEnEdicion : '',
            },
            components:{
                VPaginator: VuePaginator
            },
            methods:{
                updateResource:function (data) {
                    laddaButtonSearch.stop();
                    this.objetos = data;
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
                    toastr.info('¡Atento! Si ya existe un objeto asignado a un Tema, cree un nuevo tema para agregar el nuevo objeto.');
                },

                setFiles(files){
                  if (files !== undefined){
                      this.files = files
                  }
                },

                formReset : function (files) {
                    this.objeto ={
                        id:'',
                        titulo:'',
                        nombre_modelo:'',
                        modelo:'',
                        material:'',
                        tema_id:'',
                        time:'',
                        bd_tema:[]
                    };

                    if(this.$refs.file){
                        this.$refs.file.destroy();
                    }
                    this.setFiles(files)
                },

                complementosFiles: function () {
                    this.$http.get('/administracion/configuracion/obtener-complemento-objeto').then(
                        (response)=> {
                            this.temas = response.body.temas;
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
                            // for (let i=0; i<this.files.length; i++){
                            //     this.form.append('pics[]', this.files[i]);
                            //     console.log(this.files[i])
                            // }
                            let formData = new FormData();
                            for (let file of this.files){
                                formData.append('file[]', file, file.name)
                                // this.form.append('file[]', file, file.name)
                            }

                            formData.append('titulo', this.objeto.titulo);
                            formData.append('tema', this.objeto.tema_id);

                            this.$refs.file.value = [];

                            // document.getElementById('upload-file').value=[];
                            this.$http.post('/administracion/configuracion/guardar-objeto', formData).then((response)=>{
                                laddaButton.stop();
                                if(response.body.estado=='ok'){
                                    if(response.body.tipo == 'update'){
                                        var index = this.objetos.indexOf(this.objetoEnEdicion);
                                        toastr["success"]('Objeto actualizado correctamente.');
                                    }else{
                                        // console.log(response);
                                        // this.objeto.id = response.body.id;
                                        console.log(formData);
                                        toastr["success"]('Objeto creado correctamente.');
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

                mostrarEditar: function (objeto, index) {
                    this.objetoEnEdicion = objeto;
                    this.objeto = JSON.parse(JSON.stringify(objeto));
                    // this.modulo.estado = (this.modulo.estado == 'Activo')?1:0;
                },


                eliminarDato(objeto, index){
                    var vue = this;
                    var params ={
                        'id': vue.objetos[index].id,
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content')
                    };

                    this.$http.post('/administracion/configuracion/eliminar-objeto', params).then((response)=>{
                        if (response.body.estado=='ok'){
                            if(response.body.tipo=='delete')
                                vue.objetos.splice(objeto,1);
                            toastr.info(' Objeto  eliminado ');
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
                    app.modal.title = (app.objeto.id != ''?'Edición de ':'Nuevo ') + 'Objeto';
                    app.complementosFiles();
                });

            },
            created() {
                this.start();
            }
        });
    </script>
@endsection