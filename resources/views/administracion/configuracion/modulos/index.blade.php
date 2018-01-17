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
                            <tr v-for="modulo in modulos" >
                                <td>@{{ modulo.id }}</td>
                                <td>@{{ modulo.nombre }}</td>
                                <td>@{{ modulo.estado }}</td>
                                <td>@{{ modulo.created_at }}</td>
                                <td><button class="btn btn-sm btn-warning " v-on:click="mostrarEditar(modulo)" >Editar</button></td>
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
    <script>

        var app = new Vue({
            el: '#contenido',
            data : {
                modulos :[],
                resource_url : '/administracion/configuracion/obtener-modulos',
                datos : {
                    busqueda :''
                },
                modulo :{
                    id: '',
                    nombre: '',

                },

                moduloEnEdicion : '',
                cargando : false,
            },

            components:{
                VPaginator: VuePaginator
            },

            methods:{
                updateResource:function (data) {
                   // this.modulos = Object.assign({},this.modulos,data);
                    //laddaButtonSearch.stop();
                    this.modulos = data;
                },

                mostrarEditar: function (modulo) {
                    this.moduloEnEdicion = modulo;
                    this.modulo = JSON.parse(JSON.stringify(modulo));
                    this.modulo.estado = (this.modulo.estado == 'Activo');
                    $('#myModal').modal('show');

                },

                formReset : function () {
                    this.modulo ={
                        id: '',
                        nombre: '',
                        descripcion:'',
                        imagen:Object,
                        estado: 1,

                    }
                },


            },
            mounted(){
                var app = this;
                $("#myModal").on("hidden.bs.modal", function () {
                    app.formReset();
                });
            }
        })
    </script>
@endsection