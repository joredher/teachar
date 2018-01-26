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
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-info bg-light">
                            <tr>
                                <th>Identificación</th>
                                <th>Nombre Completo</th>
                                <th>Username</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="docente in docentes">
                                <td><span v-text="docente.identification"></span></td>
                                <td><span v-text="docente.name +' '+docente.last_name"></span></td>
                                <td><span v-text="docente.username"></span></td>
                                <td><span v-text="docente.status"></span></td>
                                <td><button class="btn btn-sm btn-warning " @click="mostrarEditar(docente)" >Editar</button></td>

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
    <script>
        var app = new Vue({
            el: '#contenido',
            data : {
                docentes:[],
                resource_url : '/administracion/configuracion/obtener-docentes',
                datos : {
                    busqueda :''
                },
                docente :{
                    id:'',
                    identification:'',
                    name:'',
                    lastname:'',
                    username:'',
                    status:'',

                },

                modal:{
                    title:'',
                },

                docenteEnEdicion : '',
                cargando : false,
            },

            components:{
                VPaginator: VuePaginator
            },

            methods:{
                updateResource:function (data) {
                    // this.modulos = Object.assign({},this.modulos,data);
                    //laddaButtonSearch.stop();
                    this.docentes = data;
                },

                mostrarEditar: function (docente) {
                    this.docenteEnEdicion = docente;
                    this.docente = JSON.parse(JSON.stringify(docente));
                    this.docente.status = (this.docente.status == 'Activo');
                },

                formReset : function () {
                    this.docente ={
                        id:'',
                        identification:'',
                        name:'',
                        lastname:'',
                        username:'',
                        status:'',

                    }
                },

                guardar : function () {
                    this.cargando = true;
                    this.$http.post('/administracion/configuracion/guardar-docente',this.docente).then((response)=>{
                        this.cargando = false;
                        if (response.body.estado == 'ok'){
                            if (response.body.tipo == 'update'){
                                var index = this.docentes.indexOf(this.docenteEnEdicion);
                                app.$refs.vpaginator.fetchData(this.resource_url);
                                $('#myModal').modal('hide');
                                this.formReset();
                                toastr.success('Docente Actualizado Correctamente.');
                            }else {
                                //nuevo
                                this.docente.id = response.body.id;
                                this.formReset();
                                app.$refs.vpaginator.fetchData(this.resource_url);
                                toastr.success('Docente Creado Correctamente');
                                $('#myModal').modal('hide');
                                this.formReset();
                            }
                        }else if (response.body.status == 'validador'){
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
                    app.modal.title = (app.docente.id != ''?'Edición de ':'Nuevo ') + 'Docente';
//                    app.complementosConceptosCartera();
                });
            }
        })
        // var app = new Vue({
        //     el : '#contenido',
        //     data:{
        //         docentes:[],
        //         resource_url: '/administracion/configuracion/obtener-docentes',
        //         datos:{
        //             busqueda:'',
        //         },
        //         docente:{
        //             id:'',
        //             identification:'',
        //             name:'',
        //             lastname:'',
        //             username:'',
        //             status:'',
        //         },
        //         docenteEnEdicion: '',
        //         cargando: false
        //     },
        //     components:{
        //         VPaginator: VuePaginator,
        //     },
        //     methods:{
        //
        //         updateResource:function (data) {
        //             // this.modulos = Object.assign({},this.modulos,data);
        //             //laddaButtonSearch.stop();
        //             this.docentes = data;
        //         },
        //
        //         mostrarEditar: function (docente) {
        //             this.docenteEnEdicion = docente;
        //             this.docente = JSON.parse(JSON.stringify(docente));
        //             this.docente.status = (this.docente.status == 'Activo');
        //             $('#myModal').modal('show');
        //
        //         },
        //
        //         formReset : function () {
        //             this.docente ={
        //                 id:'',
        //                 identification:'',
        //                 name:'',
        //                 lastname:'',
        //                 username:'',
        //                 status:'',
        //
        //             }
        //         },
        //
        //         // updateResource(data){
        //         //     // laddaButtonSearch.stop();
        //         //     this.docentes = data;
        //         // },
        //         // buscar(){
        //         //     // laddaButtonSearch.start();
        //         //     app.$refs.vpaginator.fetchData(this.resource_url)
        //         // },
        //         //
        //         // limpiarBusqueda(){
        //         //     this.datos.busqueda = '';
        //         //     // laddaButtonSearch.start();
        //         //     this.$refs.vpaginator.fetchData(this.resource_url);
        //         // },
        //     },
        //     // mounted(){
        //     //     $("#myModal").on("show.bs.modal", function () {
        //     //         // this.modal.title = (this.docente.id != ''?'Edición de ':'Nuevo ') + 'Cliente';
        //     //     });
        //     // }
        // })
    </script>
@endsection