<div class="row">
    <div class="col-md-7 col-sm-6 col-xs-12 float-xs-left">
        <button type="button" class="btn btn-home animate btn-new-1" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus" aria-hidden="true"></i>
            <span>Crear</span>
        </button>
    </div>
    <div class="col-md-5 col-sm-6 col-xs-12 float-xs-right pt-2 pl-5">
        <form class="input-group" @submit.prevent="buscar()">
            <span class="input-group-btn" v-show="datos.busqueda != ''">
                <button class="btn btn-info" type="button" @click="limpiar()"><i class="fas fa-eraser white"></i></button>
            </span>
            <input type="text" class="form-control" v-model="datos.busqueda" placeholder="Buscar.." aria-label="Filtro">
            <span class="input-group-btn">
                <button type="submit" class=" ladda-button btn btn-info ladda-button-search" data-style="expand-right">
                    <span class="ladda-label"><i class="fas fa-search white"></i></span>
                    <span class="ladda-spinner"></span>

                </button>
            </span>
        </form>
    </div>
</div>