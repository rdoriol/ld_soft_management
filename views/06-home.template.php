<?php
    if(!isset($_SESSION["loginCheck"])) {
        header("location: index.php");
        exit;   
    }
    else {
        if($_SESSION["loginCheck"]  != "ok") {
            header("location: index.php");
            exit;
        }
    }                                     
?>

INICIO ERP

Usuario: <?php echo $_SESSION["user_name"]; ?>