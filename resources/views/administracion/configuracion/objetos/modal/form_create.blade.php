<form @submit.prevent="guardar()" class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" enctype="multipart/form-data">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: inline-block">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" v-text="modal.title"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label>Nombre</label>
                        <input type="text" name="titulo" class="form-control" placeholder="Nombre de los activos" v-model="objeto.titulo" data-vv-name=" Nombre "  v-validate="'required'">
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label>Carga de Objeto/s</label>
                        <file-input :files="files" v-on:file-change="setFiles" @file-clear="clearFiles"></file-input>
                        <div class="form-group text-center" v-if="objeto.id !== ''">
                            <hr class="mb-0">
                            <label class="pt-1"><strong>Archivos Cargados</strong></label>
                            <hr class="mt-0">
                            <div class="row text-center">
                                <div class="col-sm-6">
                                    <p class="card-text">Nombre modelo: <strong v-text="objeto.nombre_modelo"></strong></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="card-text">Nombre material: <strong v-text="objeto.nombre_material"></strong></p>
                                </div>
                            </div>
                        </div>
                        {{--<input type="file" ref="file"  ref="file" class="d-none" @change="onChange" multiple>--}}
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="">Temática Objeto </label>
                        <select name="tema" id="tema" class="form-control" v-model="objeto.tema_id" data-vv-name=" Tema "  v-validate="'required'">
                            <option value="" disabled>Seleccionar tema </option>
                            <option class="text-dark" v-for="tema in temas" v-bind:value="tema.id" :hidden="tema.estado === 'Inactivo'" v-text="tema.nombre"></option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12">
                        <progress-bar :progress="progress" v-if="isUploading"></progress-bar>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-outline-grey" data-dismiss="modal" >Cancelar</button>
                <button type="submit"  class="ladda-button ladda-button-submit btn btn-info" data-style="expand-right" :disabled="disabledUploadButton">
                    <span class="ladda-label">Guardar</span>
                    <span class="ladda-spinner"></span>
                </button>
            </div>
        </div>
    </div>
</form>