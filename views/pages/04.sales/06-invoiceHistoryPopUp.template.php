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
        

<h4 class="forms_subtitle rounded title_h2">Buscar Facturas</h4>

        <!-- SEARCH BAR
            ---------------------->
        <?php include "05-invoiceHistorySearchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="invoice_history_lists_table">
    <thead>
        <tr>
            <th>Fecha</th><th>Nº Factura</th><th>Nº Cliente</th><th>Cliente</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $key = $_POST["select_item"];
                $value = $_POST["search_key"];      
                $valueDate = $_POST["calendar"];     
                
                $dataInvoice = SalesController::ctrToListOutputsProducts("customer_invoices", $key, $value, $valueDate);       
                foreach($dataInvoice as $item):                        
            ?>
            <tr class="table_search" title="Seleccionar" onClick="getSubwindowOutputProduct(<?php echo '\''. $item->token_customer_invoice .'\''; ?>);">
                <td> <?php echo $item->created_date_customer_invoice; ?> </td>       
                <td> <?php echo $item->output_number; ?> </td>           
                <td> <?php echo $item->id_customer_ci; ?> </td>                  
                <td> <?php echo $item->name_customer; ?> </td>                 
            </tr>                                                               
            <?php endforeach ?>   
        <tbody>
</table>

<button type="button" class="btn btn-primary mr-5 mt-5" id="btn_input_product_close" name=""><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar</button>

<!-- JavaScript para limpiar historial del formulario de búsqueda -->
<script>                
    window.history.replaceState(null, null, window.location.href);
</script>