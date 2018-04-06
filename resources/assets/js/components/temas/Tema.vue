<template>
    <div>
        <div>
            <div class="cards">
                <a class="tcard [ is-collapsed ]" v-for="tema in modulo.bd_tema">
                    <div class="tcard__inner [ js-expander ]" >
                        <h4 v-text="tema.nombre"></h4>
                        <i class="fas fa-folder"></i>
                    </div>
                    <div class="tcard__expander">
                        <i class="fas fa-times-circle [ js-collapser ]"></i>
                        <p> <span v-text="tema.contenido"></span></p>
                        <!--<div class="content-back d-inline-block text-center">-->
                        <!--&lt;!&ndash;<P class="card-text text-justify" v-text="tema.descripcion"></P>&ndash;&gt;-->
                        <!--&lt;!&ndash;<br/>&ndash;&gt;-->
                        <!--&lt;!&ndash;<p id="tema"></p>&ndash;&gt;-->
                        <!--&lt;!&ndash;<a :href="'/usuarios/configuracion/modulo/'+modulo.id" class="btn btn_push underline text-light"> Ir </a>&ndash;&gt;-->
                        <!--</div>-->
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name:'temas',
        props:['modulo'],
        data: function () {
            return {
                coloress: ['bg-success', 'bg-dark', 'bg-danger','bg-info'],
            }
        },
        methods:{
            color() {
                return this.coloress[Math.floor(Math.random() * this.coloress.length)];
            },
        },
        mounted(){
            var $cell = $('.tcard');

            //open and close card when clicked on card
            $cell.find('.js-expander').click(function() {

                var $thisCell = $(this).closest('.tcard');

                if ($thisCell.hasClass('is-collapsed')) {
                    $cell.not($thisCell).removeClass('is-expanded').addClass('is-collapsed').addClass('is-inactive');
                    $thisCell.removeClass('is-collapsed').addClass('is-expanded');

                    if ($cell.not($thisCell).hasClass('is-inactive')) {
                        //do nothing
                    } else {
                        $cell.not($thisCell).addClass('is-inactive');
                    }

                } else {
                    $thisCell.removeClass('is-expanded').addClass('is-collapsed');
                    $cell.not($thisCell).removeClass('is-inactive');
                }
            });

            //close card when click on cross
            $cell.find('.js-collapser').click(function() {

                var $thisCell = $(this).closest('.tcard');

                $thisCell.removeClass('is-expanded').addClass('is-collapsed');
                $cell.not($thisCell).removeClass('is-inactive');

            });
        }
    };
</script>