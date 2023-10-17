<h2 class="li_active_page rounded">Listado Clientes</h2>

<h4 class="forms_subtitle rounded">Buscar Registros</h4>

        <!-- SEARCH BAR
            ---------------------->
        <?php include "03-customerSearchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="customers_lists_table">
    <thead>
        <tr>
            <th>Id</th><th>NIF</th><th>Nombre</th><th>Teléfono</th><th>Correo Electrónico</th><th>Dirección</th><th>Código Postal</th><th>Población</th><th>Provincia</th><th>País</th><th>Editar</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                $key = $_POST["select_item"];
                $value = $_POST["search_key"];                
                
                $dataCustomers = CustomerController::ctrToList("customers", $key, $value); 
                foreach($dataCustomers as $item): 
            ?>
            <tr>
                <td> <?php echo $item->id; ?> </td>
                <td> <?php echo $item->nif_cif; ?> </td>
                <td> <?php echo $item->name_customer; ?> </td>
                <td> <?php echo $item->phone; ?> </td>
                <td> <?php echo $item->email; ?> </td>
                <td> <?php echo $item->address_customer; ?> </td>
                <td> <?php echo $item->postal_code; ?> </td>
                <td> <?php echo $item->town; ?> </td>
                <td> <?php echo $item->province; ?> </td>
                <td> <?php echo $item->country; ?> </td>               
                <td>
                    <a href="index.php?pages=01-newCustomer&token=<?php echo $item->token; ?>" class="btn btn-warning m-1" title="Ver / Editar registro"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        <tbody>
</table>

<!-- JavaScript para limpiar historial del formulario de búsqueda -->
<script>                
    window.history.replaceState(null, null, window.location.href);
</script>