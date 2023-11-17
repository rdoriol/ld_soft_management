
<?php    
/**
 * Se limpian array $_SESSION, se destruye la sesión y se redirecciona a la página de login
 */   
    if(isset($_GET["pages"]) && $_GET["pages"] == "07-exit") {
        $_SESSION = array();

        session_destroy();

        setcookie("token_customer_invoice", ""); // Se borra valor de Cookie creada con caducidad de 1 día.
                      
        header("location: index.php");
        exit;
    }
