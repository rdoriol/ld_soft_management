<h2 class="li_active_page rounded">Listados Productos</h2>

<h4 class="forms_subtitle rounded">Buscar Registros</h4>

        <!-- SEARCH BAR
            ---------------------->

        <?php  include "04-inventorySearchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="products_lists_table">
    <thead>
        <tr>
            <th>Id</th><th>Ref.Original</th><th>Nombre</th><th>Unidades</th><th>Último coste</th><th>PVP</th><th>Categoría</th><th>Editar</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                
                $key = $_POST["select_item"];
                $value = $_POST["search_key"]; 

                $dataProducts = InventoryController::ctrToListProduct("products", $key, $value);  // Consulta a la tabla "products"
                
                foreach($dataProducts as $itemProduct):                  
            ?>
            <tr>
                <td> <?php echo $itemProduct->id_product; ?> </td>
                <td> <?php echo $itemProduct->or_product; ?> </td>
                <td> <?php echo $itemProduct->name_product; ?> </td>
                <td> <?php echo $itemProduct->units_product; ?> </td>
                <td> <?php echo $itemProduct->last_unit_cost_product; ?> </td>
                <td> <?php echo $itemProduct->sale_price_product; ?> </td>
                <td> <?php echo $itemProduct->name_product_category; ?> </td>
                <td>
                    <a href="index.php?pages=01-newProduct&token=<?php echo $itemProduct->token_product; ?>" class="btn btn-warning m-1" title="Ver / Editar registro"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                </td>
            </tr>
                        
            <?php                    
                endforeach; ?>
        <tbody>
</table>

<!-- JavaScript para limpiar historial del formulario de búsqueda -->
<script>                
    window.history.replaceState(null, null, window.location.href);
</script>