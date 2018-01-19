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
                       <button type="button" class="btn-home animate btn-new-1" data-toggle="modal" data-target="#myModal">
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
                                <td><span v-text="docente.name + docente.lastname"></span></td>
                                <td><span v-text="docente.username"></span></td>
                                <td><span v-text="docente.status"></span></td>
                                <td><button class="btn btn-sm btn-warning " v-on:click="mostrarEditar(docente)" >Editar</button></td>

                            </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <v-paginator ref="vpaginator" :resource="resource_url" @update="updateResource" :datos="datos"></v-paginator>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el : '#contenido',
            data:{
                docentes:[],
                resource_url: '/administracion/configuracion/obtener-docentes',
                datos:{
                    busqueda:'',
                },
                docente:{
                    id:'',
                    identification:'',
                    name:'',
                    lastname:'',
                    username:'',
                    status:'',
                },
                docenteEnEdicion: '',
                cargando: false
            },
            components:{
                VPaginator: VuePaginator,
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
                    $('#myModal').modal('show');

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

                // updateResource(data){
                //     // laddaButtonSearch.stop();
                //     this.docentes = data;
                // },
                // buscar(){
                //     // laddaButtonSearch.start();
                //     app.$refs.vpaginator.fetchData(this.resource_url)
                // },
                //
                // limpiarBusqueda(){
                //     this.datos.busqueda = '';
                //     // laddaButtonSearch.start();
                //     this.$refs.vpaginator.fetchData(this.resource_url);
                // },
            },
            // mounted(){
            //     $("#myModal").on("show.bs.modal", function () {
            //         // this.modal.title = (this.docente.id != ''?'Edición de ':'Nuevo ') + 'Cliente';
            //     });
            // }
        })
    </script>
@endsection