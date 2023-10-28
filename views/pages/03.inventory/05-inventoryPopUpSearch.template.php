<!-- CSS PERSONALIZADO
        ---------------------->
        <style>@import url("./css/styles-06-search.template.php.css");</style>
        

<h4 class="forms_subtitle rounded">Buscar Registros</h4>

        <!-- SEARCH BAR
            ---------------------->
        <?php include "04-inventorySearchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="products_lists_table">
    <thead>
        <tr>
            <th>Id</th><th>Ref.Original</th><th>Nombre</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $key = $_POST["select_item"];
                $value = $_POST["search_key"];                
                
                $dataProducts = InventoryController::ctrToListProduct("products", $key, $value);       
                foreach($dataProducts as $item):                        
            ?>
            <tr class="table_search" title="Seleccionar" onClick="getSubwindowProduct(<?php echo '\''. $item->token_product .'\''; ?>);">
                <td> <?php echo $item->id_product;?> </td>           
                <td> <?php echo $item->or_product; ?> </td>
                <td> <?php echo $item->name_product; ?> </td>                 
            </tr>                                                               
            <?php endforeach ?>   
        <tbody>
</table>

<button type="button" class="btn btn-primary mr-5 mt-5" id="btn_input_product_close" name=""><i class="fa-sharp fa-solid fa-rectangle-xmark"></i>&nbsp Cerrar</button>

<!-- JavaScript para limpiar historial del formulario de búsqueda -->
<script>                
    window.history.replaceState(null, null, window.location.href);
</script>