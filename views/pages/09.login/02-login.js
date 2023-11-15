
$(document).ready(function() {
    /**
     * Función que abrirá modal para preguntar a usario si desea Cerrar Sesión desde menú lateral
     */
   
    $("#session_close, #session_close_home, #exit_button").click(function(){
    
        $("#exit_modal").modal("show");
        $("#btn_ok_exit").click(function(){
            $("#exit_modal").modal("hide"); 
            window.location.replace('index.php?pages=07-exit');
        })
})

    /**
     * Función que ocultará/mostrará contraseña de login
     */
    $(".eye_pwd").click(function() {
        var eyeState = $("#pass").attr("type"); // Se almacena type del input password

        if(eyeState == "password") {
            $("#pass").attr("type", "text");
            $(".eye_pwd").attr("src", "./images/login/hide_icon.png");
        }
        else {
            $("#pass").attr("type", "password");
            $(".eye_pwd").attr("src", "./images/login/show_icon.png");
        }
    })
})
