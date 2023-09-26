<h2 class="li_active_page rounded">Listado Clientes</h2>

<ul class="general_options_bar" id="">
    <li>
        <form class="general_searchs_forms" id="" action="" method="post">     
            <legend><i class="fa-solid fa-user forms_icons"></i>Buscar clientes</legend>
            <select class="" id="" name="select_item">
                <option vaule="" selected disabled="true">Filtrar búsqueda</option>
                <option value="full_list">Listado completo</option>
                <option value="id_customer">Id</option>
                <option value="name_customer">Nombre</option>
                <option value="nif_cif">NIF_CIF</option>
                <option value="customer_type">Particular / Empresa</option>
                <option value="address_customer">Dirección</option>
                <option value="postal_code">Código postal</option>
                <option value="town">Población</option>
                <option value="province">Provincia</option>
                <option value="country">País</option>
                <option value="phone">Teléfono</option>
                <option value="email">Correo electrónico</option>
                <option value="created_date">Fecha de alta</option>
            </select>
            <input type="text" class="" id="" name="search_key" placeholder="búsqueda">
            <button type="submit" class="btn btn-primary" id="btn_search" name="search"><i class="fa-solid fa-magnifying-glass"></i><a href="index.php?pages=04-customersList&select=<?php echo $_POST['select_item']  ?>">&nbsp Buscar</a></button>
        </form>
    </li>
    <li>imprimir</li>
</ul> 

<table class="general_tables table table-striped text-center" id="customers_lists_table">
    <thead>
        <tr>
            <th>Id</th><th>NIF-CIF</th><th>Nombre</th><th>Teléfono</th><th>Correo Electrónico</th><th>Dirección</th><th>Código Postal</th><th>Población</th><th>Provincia</th><th>País</th><th>Fecha registro</th>
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
                <td> <?php echo $item->phone; ?> </td>
                <td> <?php echo $item->email; ?> </td>
                <td> <?php echo $item->address_customer; ?> </td>
                <td> <?php echo $item->postal_code; ?> </td>
                <td> <?php echo $item->town; ?> </td>
                <td> <?php echo $item->province; ?> </td>
                <td> <?php echo $item->country; ?> </td>
                <td> <?php echo $item->created_date; ?> </td>
                <td>
                    <a href="index.php?pages=01-newCustomer&token=<?php echo $item->token; ?>" class="btn btn-warning m-1" title="Editar registro"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                </td>
            </tr>
            <?php endforeach ?>
        <tbody>
</table>

<!-- JavaScript para limpiar historial del formulario de búsqueda -->
<script>                
    window.history.replaceState(null, null, window.location.href);
</script>


<!-- ------------------------ ELIMINAR ---------------------------------- 

<div class="container">
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Fecha registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                //$toList = FormController::ctrToListTable();
                //foreach($toList as $item): 
            ?>            
            <tr>
                <td><?php //echo $item->id; ?></td>
                <td><?php //echo $item->user_name; ?></td>
                <td><?php //echo $item->email; ?></td>
                <td><?php //echo $item->date_register; ?></td>
                <td>
                    <div class="btn-group">
                        <a href="index.php?pages=edit&token=<?php //echo $item->token; ?>" class="btn btn-warning m-1"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                        <form method="post"> 
                            <input type="hidden" value="<?php// echo $item->token; ?>" name="inputDelete">
                            <button type="submit" class="btn btn-danger m-1" name="btn-delete"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php //endforeach ?>
            <?php 
                //$delete = new FormController();
                //$delete->ctrDelete();
            ?>
        </tbody>
    </table>
</div>

-->