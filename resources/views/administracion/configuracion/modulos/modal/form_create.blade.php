<form @submit.prevent="guardar()" class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: inline-block">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" v-text="modal.title"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
                        <label for="">Nombre </label>
                        <input type="text" class="form-control" v-model="modulo.nombre" :disabled="modulo.id !=''" data-vv-name=" Nombre " v-validate="'required'">
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
                        <label for="">Descripción </label>
                        <textarea class="form-control" v-model="modulo.descripcion" data-vv-name=" Descripción " rows="4" style="resize: none"></textarea>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" >
                        {{--<label for="">Imagen de Módulo </label>--}}
                        {{--<input type="file" class="form-control" name="image" id="image" >--}}

                        {{--<div class="kv-avatar">--}}
                            {{--<div class="file-input">--}}
                                {{--<div class="file-preview" style="text-align: center">--}}
                                    {{--<div class="file-drop-disabled">--}}
                                        {{--<div class="file-preview-thumbnails">--}}
                                            {{--<div class="file-default-preview clickable" tabindex="-2">--}}
                                                {{--<img src="{{ asset('imagenes/default_avatar_male.jpg') }}" alt="Your Avatar">--}}
                                                {{--<h6 class="text-muted">Click to select</h6>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="clearfix"></div>--}}
                                        {{--<div class="file-preview-status text-center text-success"></div>--}}
                                        {{--<div class="kv-fileinput-error"></div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<button type="button" class="btn btn-secondary" title="Add picture tags" onclick="alert('Call your custom code here.')">--}}
                                    {{--<i class="glyphicon glyphicon-tag"></i>--}}
                                {{--</button>--}}
                                {{--<button type="button" tabindex="500" title="Cancel or reset changes" class="btn btn-default btn-secondary fileinput-remove fileinput-remove-button">--}}
                                    {{--<i class="glyphicon glyphicon-remove"></i>--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="card form-group pt-2" v-if="modulo.id != ''" @change="imageChanged">--}}
                            {{--<img class="card-img-top" :src="'http://localhost:8000/' + modulo.imagen" alt="Card image cap">--}}
                        {{--</div>--}}

                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12"   v-if="modulo.id !=''">
                            <label for="">Estado</label>
                            <switch-ts id="estado" :value="modulo.estado" @update:value="val => modulo.estado = val"></switch-ts>
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