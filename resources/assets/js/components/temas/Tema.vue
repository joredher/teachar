<template>
    <div>
        <scrolly class="vertical-scrollbar-demo" :passive-scroll="true" @scrollchange="logScrollLayout">
            <scrolly-viewport>
                <div>
                    <div class="cards slideInDown animated">
                        <a class="tcard [ is-collapsed ]"  v-for="tema in modulo.bd_tema" >
                            <div class="tcard__inner [ js-expander ]" :class="color() && {desactivo: desactivado(tema)}" >
                                <h4 v-text="tema.nombre"></h4>
                                <i class="fas fa-folder"></i>
                            </div>
                            <div v-show="tema.estado !== 'Inactivo'" class="tcard__expander">
                                <i class="fas fa-times-circle [ js-collapser ]"></i>
                                <div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="display-4" v-text="tema.nombre + ':'"></h1>
                                            <p class="lead text-justify" v-text="tema.descripcion"></p>
                                            <hr class="my-4">
                                            <a :href="'/usuario/modulo/tema/'+ tema.slug" class="btn btn_eye underline">
                                                <i class="fas fa-eye-slash fa-w-16 fa-5x position-absolute"></i>
                                                <i class="fas fa-eye fa-w-16 fa-5x"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </scrolly-viewport>
            <scrolly-bar axis="y"></scrolly-bar>
        </scrolly>
        <!--<div id="player"></div>-->
    </div>
</template>
<script>
    import { Scrolly, ScrollyViewport, ScrollyBar } from 'vue-scrolly';
    export default {
        name:'temas',
        props:['modulo'],
        data: function () {
            return {
                // coloress: ['bg-success', 'bg-dark', 'bg-danger','bg-info'] 'color_bg_primero', ,
                coloress: ['color_bg_segundo', 'color_bg_tercero','color_bg_cuarto'],
            }
        },
        components: {
            Scrolly,
            ScrollyViewport,
            ScrollyBar
        },
        methods:{
            color() {
                return this.coloress[Math.floor(Math.random() * this.coloress.length)];
            },

            desactivado(tema){
                return tema.estado === 'Inactivo';
            },
            logScrollLayout(scrollLayout) {
                console.log('scrollLayout:', scrollLayout);
            }
        },
        mounted(){
            console.clear();

            $('.btn_eye').tooltip({
                'show':true,
                'placement': 'right',
                'title': 'Aumenta la experiencia...'
            });

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