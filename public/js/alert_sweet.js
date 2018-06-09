console.clear();
$(document).ready(function(){
    $("#user-username").on('paste', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $("#user-password").on('paste', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");

    });

    $("#user-username").on('copy', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $("#user-password").on('copy', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $("#user-username").on('cut', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $("#user-password").on('cut', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $(".btn_login").on('click', function (e) {
        // e.preventDefault();
        if ($('#user-username').val() === '' && $('#user-password').val() === '' ){
            swal( "¡Vaya! " , "¡Ningún campo debe estar vacío! " , "warning" )   ;
        }

    })

});

$(document).ready(function(){
    $("#email").on('paste', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $("#email").on('copy', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $("#email").on('cut', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $(".btn_login").on('click', function (e) {
        // e.preventDefault();
        if ($('#email').val() === ''){
            swal( "¡Vaya! " , "¡El campo correo electrónico no debe estar vacío! " , "warning" );
        }

    })

});

$(document).ready(function(){
    $("#password").on('paste', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");

    });

    $("#password-confirm").on('paste', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");

    });

    $("#password").on('copy', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $("#password-confirm").on('copy', function(e){
        e.preventDefault();
        swal("Oops", "¡Acción no Permitida!", "error");
    });

    $(".btn_login").on('click', function (e) {
        // e.preventDefault();
        if ($('#password').val() === '' || $('#password-confirm').val() === '' ){
            swal( "¡Vaya! " , "¡Ningún campo debe estar vacío! " , "warning" )   ;
        }

    })

});