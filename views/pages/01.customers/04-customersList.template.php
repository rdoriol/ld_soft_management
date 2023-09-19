<h2 class="li_active_page rounded">Listado Clientes</h2>

<ul class="general_options_bar" id="">
    <li>
        <form class="general_searchs_forms" id="">     
            <legend><i class="fa-solid fa-user forms_icons"></i>Buscar clientes</legend>
            <select class="" id="" name="filter_customer_fields">
                <option vaule="" selected disabled="true">Filtrar búsqueda</option>
                <option value="">Listado completo</option>
                <option value="">2ª opcion</option>
            </select>
            <input type="text" class="" id="" name="" placeholder="búsqueda">
            <button type="submit" class="forms_buttons" id="" name="search_customers">buscar</button>
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
            <tr>
                <td>
                   <?php echo "ole";?>
                </td>
            </tr>
        <tbody>
</table>




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