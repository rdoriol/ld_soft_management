<h2 class="li_active_page rounded">Listados Proveedores</h2>

<h4 class="forms_subtitle rounded">Buscar Registros</h4>

        <!-- SEARCH BAR
            ---------------------->

        <?php  include "03-supplierSearchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="suppliers_lists_table">
    <thead>
        <tr>
            <th>Id</th><th>NIF</th><th>Nombre</th><th>Teléfono</th><th>Correo Electrónico</th><th>Dirección</th><th>Código Postal</th><th>Población</th><th>Provincia</th><th>País</th><th>Editar</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $key = $_POST["select_item"];
                $value = $_POST["search_key"];                
                    // utilizo función ya implementada en la clase CustomerController
                $dataSuppliers = CustomerController::ctrToList("suppliers", $key, $value); 
                foreach($dataSuppliers as $item): 
            ?>
            <tr>
                <td> <?php echo $item->id; ?> </td>
                <td> <?php echo $item->nif; ?> </td>
                <td> <?php echo $item->name_supplier; ?> </td>
                <td> <?php echo $item->phone; ?> </td>
                <td> <?php echo $item->email; ?> </td>
                <td> <?php echo $item->address; ?> </td>
                <td> <?php echo $item->postal_code; ?> </td>
                <td> <?php echo $item->town; ?> </td>
                <td> <?php echo $item->province; ?> </td>
                <td> <?php echo $item->country; ?> </td>               
                <td>
                    <a href="index.php?pages=01-newSupplier&token=<?php echo $item->token; ?>" class="btn btn-warning m-1" title="Ver / Editar registro"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        <tbody>
</table>


<!-- JavaScript para limpiar historial del formulario de búsqueda -->
<script>                
    window.history.replaceState(null, null, window.location.href);
</script>
