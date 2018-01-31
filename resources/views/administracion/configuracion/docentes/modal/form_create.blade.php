<form @submit.prevent="guardar()" class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="display: inline-block">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" v-text="modal.title"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4"  >
                        <label for="">Identificación </label>
                        <input type="number" class="form-control" v-model="docente.identification" :disabled="docente.id !=''" v-validate="'required'">
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4"  >
                        <label for="">Nombre </label>
                        <input type="text" class="form-control" v-model="docente.name"  v-validate="'required'">
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-4"  >
                        <label for="">Apellido </label>
                        <input type="text" class="form-control" v-model="docente.last_name" v-validate="'required'">
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6"  >
                        <label for="">Nombre de Usuario </label>
                        <input type="text" class="form-control" v-model="docente.username" v-validate="'required'" :disabled="docente.id !=''">
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">
                        <label for="">Correo Electónico</label>
                        <input type="email" class="form-control" v-model="docente.email" v-validate="'required'">
                    </div>
                    <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label for="">Estado</label>
                        <switch-ts id="state" :value="docente.state" @update:value="val => docente.state = val"></switch-ts>
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