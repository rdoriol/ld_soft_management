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
        

<h4 class="forms_subtitle rounded title_h2">Buscar Entradas Productos</h4>

        <!-- SEARCH BAR
            ---------------------->
        <?php include "06-inputProductSearchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="inputs_products_lists_table">
    <thead>
        <tr>
            <th>Fecha Entrada</th><th>NºEntrada</th><th>Proveedor</th><th>Subtotal sin Impuestos (€)</th><th>Total Entrada (€)</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $key = $_POST["select_item"];
                $value = $_POST["search_key"];      
                $valueDate = $_POST["calendar"];     
                
                $dataInputsProducts = ProductInputController::ctrToListInputProduct("supplier_invoices", $key, $value, $valueDate);       
                foreach($dataInputsProducts as $item):                        
            ?>
            <tr class="table_search" title="Seleccionar" onClick="getSubwindowInputProduct(<?php echo '\''. $item->token_supplier_invoice .'\''; ?>);">
                <td> <?php echo $item->created_date_supplier_invoice; ?> </td>       
                <td> <?php echo $item->input_number;?> </td>           
                <td> <?php echo $item->name_supplier; ?> </td>                  
                <td> <?php echo $item->subtotal_with_discount; ?> </td> 
                <td> <?php echo $item->total_input; ?> </td> 
            </tr>                                                               
            <?php endforeach ?>   
        <tbody>
</table>

<button type="button" class="btn btn-primary mt-5 mb-5" id="btn_customers_close" name=""><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar</button>

<!-- JavaScript para limpiar historial del formulario de búsqueda -->
<script>                
    window.history.replaceState(null, null, window.location.href);
</script>