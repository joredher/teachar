<form @submit.prevent="guardar()" class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: inline-block">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" v-text="modal.title"></h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div id="tab-style">
                        <ul class="nav nav-tabs nav-top-border nav-justified  no-hover-bg nav-tabs-modulo">
                            <li class="nav-item"><a class="nav-link text-info active" data-toggle="tab" href="#tab-1" aria-expanded="true"><i class="fas fa-indent"></i> Información Básica</a></li>
                            <li class="nav-item"><a class="nav-link text-info" data-toggle="tab" href="#tab-2" aria-expanded="false"><i class="fas fa-file-image"></i> Agregar Imagen</a></li>
                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div id="tab-1" class="tab-pane active">
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
                                        <label for="">Nombre </label>
                                        <input type="text" class="form-control" v-model="modulo.nombre" :disabled="modulo.id !=''" data-vv-name=" Nombre " v-validate="'required'">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
                                        <label for="">Descripción </label>
                                        <textarea class="form-control" v-model="modulo.descripcion" data-vv-name=" Descripción " rows="4" style="resize: none"></textarea>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" v-if="modulo.id != '' && modulo.foto">
                                        <label for="">Imagen Actual: </label>
                                       <div>
                                           <img :src="modulo.foto" class="img-thumbnail mx-auto d-block" width="50%">
                                           {{--<img :src="'http://localhost:8000/imagenes/modulos/' + modulo.imagen" class="img-thumbnail mx-auto d-block" width="50%">--}}
                                       </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12"   v-if="modulo.id !=''">
                                        <label for="">Estado</label>
                                        <switch-ts id="estado" :value="modulo.estado" @update:value="val => modulo.estado = val"></switch-ts>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <vcropp ref="vcropp"
                                                    min-width="400"
                                                    min-heigth="250"
                                                    :ratio="1"
                                                    :preview="true"
                                                    :preview-rounded="true">
                                        </vcropp>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-outline-grey" data-dismiss="modal" >Cancelar</button>
                <button type="submit"  class="ladda-button ladda-button-submit btn btn-info" data-style="expand-right">
                    <span class="ladda-label">Guardar</span>
                    <span class="ladda-spinner"></span>
                </button>
            </div>
        </div>
    </div>
</form>