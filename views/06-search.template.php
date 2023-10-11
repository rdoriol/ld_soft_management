<!-- CSS PERSONALIZADO
        ---------------------->
        <style>@import url("./css/styles-06-search.template.php.css");</style>
        

<h4 class="forms_subtitle rounded">Buscar Registros</h4>

        <!-- SEARCH BAR
            ---------------------->
        <?php include "views/05-searchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="customers_lists_table">
    <thead>
        <tr>
            <th>Id</th><th>NIF</th><th>Nombre</th><th>Editar</th>
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
                <td> <?php echo $item->id_customer; ?> </td>
                <td> <?php echo $item->nif_cif; ?> </td>
                <td> <?php echo $item->name_customer; ?> </td>                             
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