
<?php    
/**
 * Se limpian array $_SESSION, se destruye la sesión y se redirecciona a la página de login
 */
    $_SESSION = array();

    session_destroy();
                  
    header("location: index.php");
    exit;
?>
