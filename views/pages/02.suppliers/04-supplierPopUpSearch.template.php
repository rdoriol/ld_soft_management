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

<!-- CSS PERSONALIZADO
        ---------------------->
        <style>@import url("./css/styles-06-search.template.php.css");</style>
        

<h4 class="forms_subtitle rounded">Buscar Proveedores</h4>

        <!-- SEARCH BAR
            ---------------------->
        <?php include "03-supplierSearchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="supplier_lists_table">
    <thead>
        <tr>
            <th>Id</th><th>NIF</th><th>Nombre</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $key = $_POST["select_item"];
                $value = $_POST["search_key"];                
                
                $dataSuppliers = CustomerController::ctrToList("suppliers", $key, $value);       
                foreach($dataSuppliers as $item):                        
            ?>
            <tr class="table_search" title="Seleccionar" onClick="getSubwindowSupplier(<?php echo '\''. $item->token .'\''; ?>);">
                <td> <?php echo $item->id;?> </td>           
                <td> <?php echo $item->nif; ?> </td>
                <td> <?php echo $item->name_supplier; ?> </td>                 
            </tr>                                                               
            <?php endforeach ?>   
        <tbody>
</table>

<button type="button" class="btn btn-primary mr-5 mt-5 mb-5" id="btn_customers_close" name=""><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar</button>


<!-- JavaScript para limpiar historial del formulario de búsqueda -->
<script>                
    window.history.replaceState(null, null, window.location.href);
</script>