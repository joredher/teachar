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
                                <th class="text-left">Identificación</th>
                                <th class="text-left">Nombre Completo</th>
                                <th class="text-center">Username</th>
                                <th class="text-left">Estado</th>
                                <th class="text-left">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(docente, index) in docentes">
                                <td class="text-left"><span class="text-right" v-text="docente.identification"></span></td>
                                <td class="text-left"><span v-text="docente.name +' '+docente.last_name"></span></td>
                                <td class="text-center"><span v-text="docente.username"></span></td>
                                <td class="text-left"><span v-text="docente.state"></span></td>
                                <td class="row mr-auto text-center pl-4">
                                    <div class="col-xs-1 pr-1">
                                        <button class="btn btn-sm btn-info " @click="mostrarEditar(docente, index)" ><i class="fas fa-edit"></i></button>
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
                docente :{
                    id:'',
                    identification:'',
                    name:'',
                    last_name:'',
                    username:'',
                    email:'',
                    password: '',
                    state:'',
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
                    this.docentes = data;
                    console.log(data)
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

                mostrarEditar: function (docente, index) {
                    this.docenteEnEdicion = docente;
                    this.docente = JSON.parse(JSON.stringify(docente));
                    this.docente.state = (this.docente.state == 'Activo');
                    $('#myModal').modal('show');

                },

                eliminarDato(docente, index){
                    // this.docentes.splice(docente, 1);

                    // console.log('Eliminar ' + index);
                    // this.docentes.splice(index, 1);
                    var vue = this;

                    // console.log(docente.id);

                    var params ={
                        'id': this.docentes[docente, index].id,
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('contenido')
                    };

                    this.$http.post('/administracion/configuracion/docentes', params, function (data) {
                        if (data.success){
                            vue.docentes.splice(vue.docentes.indexOf(docente, index), 1);
                        }
                    }, 'json');

                },


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
        })
    </script>
@endsection