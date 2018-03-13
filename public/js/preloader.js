/**Código Preload hecho por Eduardo Hernández**/
$(document).ready(function($) {
    var Body = $('body');
    Body.addClass('preloader-site');
});
$(window).on('load', function() {
    $('body').removeClass('preloader-site');
    if ($('main') !==false){
        $('.preloader-wrapper').hide();
    }
});
