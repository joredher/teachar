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
                form: new FormData,
                // files:[],
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

                setFiles(files){
                  if (files !== undefined){
                      this.files = files
                  }
                },

                formReset : function () {
                    this.objeto ={
                        id:'',
                        nombre:'',
                        objeto:'',
                        material:'',
                        capaOne:'',
                        capaTwo:'',
                        tema_id:'',
                        time:''
                    };
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

                // guardar : function () {
                //     let formData = new FormData();
                //     for(let  file of this.files){
                //         formData.append('file_name[]', file, file.name);
                //     }
                //
                //     this.$http.post('/administracion/configuracion/guardar-objeto', formData)
                //         .then((response) => {
                //             toastr["success"]('Objeto creado correctamente.');
                //         },(error) => {
                //             toastr.error(error.status + ' '+error.statusText+' ('+error.url+')');
                //         }
                //     );
                //     // alert(this.files.name)
                // },

                guardar : function () {
                    var app = this;
                    this.$validator.validateAll().then((result) => {
                        if (result) {
                            laddaButton.start();
                            for (let i=0; i<this.files.length; i++){
                                this.form.append('pics[]', this.files[i]);
                                console.log(this.files[i])
                            }

                            this.$refs.file.value = [];
                            // document.getElementById('upload-file').value=[];
                            // this.modulo.foto = this.$refs.vcropp.getImage();
                            this.$http.post('/administracion/configuracion/guardar-objeto',this.objeto && this.form).then((response)=>{
                                laddaButton.stop();
                                console.log(this.files[id]);
                                if(response.body.estado=='ok'){
                                    if(response.body.tipo == 'update'){
                                        var index = this.objetos.indexOf(this.objetoEnEdicion);
                                        toastr["success"]('Objeto actualizado correctamente.');
                                    }else{
                                        console.log(response);
                                        this.objeto.id = response.body.id;
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

            }
        });
    </script>

@endsection