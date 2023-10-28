<!-- CSS PERSONALIZADO
        ---------------------->
        <style>@import url("./css/styles-06-search.template.php.css");</style>
        

<h4 class="forms_subtitle rounded">Buscar Registros</h4>

        <!-- SEARCH BAR
            ---------------------->
        <?php include "03-customerSearchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="customers_lists_table">
    <thead>
        <tr>
            <th>Id</th><th>NIF</th><th>Nombre</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $key = $_POST["select_item"];
                $value = $_POST["search_key"];                
                
                $dataCustomers = CustomerController::ctrToList("customers", $key, $value);       
                foreach($dataCustomers as $item):                        
            ?>
            <tr class="table_search" title="Seleccionar" onClick="getSubwindowValues(<?php echo '\''. $item->token .'\''; ?>);">
                <td> <?php echo $item->id;?> </td>           
                <td> <?php echo $item->nif_cif; ?> </td>
                <td> <?php echo $item->name_customer; ?> </td>                 
            </tr>                                                               
            <?php endforeach ?>   
        <tbody>
</table>

<button type="button" class="btn btn-primary mr-5 mt-5" id="btn_customers_close" name=""><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar</button>


<!-- JavaScript para limpiar historial del formulario de búsqueda -->
<script>                
    window.history.replaceState(null, null, window.location.href);
</script>