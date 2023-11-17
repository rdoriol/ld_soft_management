<?php
      // Condición para verificar que se ha iniciado sesión por usuario, si no es así, se reenviará a página de login 
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

<h1>Listado Empleados</h1>
<h3>En construcción...</h3>