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
                        <input type="text" class="form-control" v-model="tema.nombre" :disabled="tema.id !=''" v-validate="'required'">
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12"  >
                        <label for="">Contenido </label>
                        <textarea class="form-control" v-model="tema.contenido" rows="4" style="resize: none"></textarea>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="">Módulo </label>
                        <select name="" id="" class="form-control" v-model="tema.modulo_id" v-validate="'required'">
                            <option value="" disabled>Seleccionar Opción </option>
                            <option v-for="modulo in modulos" v-bind:value="modulo.id" v-text="modulo.nombre"></option>
                        </select>
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12"   v-if="tema.id !=''">
                        <label for="">Estado</label>
                        <switch-ts id="estado" :value="tema.estado" @update:value="val => tema.estado = val"></switch-ts>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-outline-grey" data-dismiss="modal" >Cancelar</button>
                <button type="submit"  class="ladda-button ladda-button-submit btn btn-success" data-style="expand-right">
                    <span class="ladda-label">Guardar</span>
                    <span class="ladda-spinner"></span>
                </button>
            </div>
        </div>
    </div>
</form>