<ul class="general_options_bar" id="">
    <li>
        <form class="general_searchs_forms" id="" action="" method="post">     
                      
            <select class="bar_search select_product select_search" id="" name="select_item">
                <option vaule="" selected disabled="true">Filtrar búsqueda</option>
                <option value="full_list">Listado completo</option>
                <option value="ci.output_number">Nº Factura</option> <!-- customer invoice output_number -->
                <option value="id_customer_ci">Nº Cliente</option>                
                <option value="name_customer">Nombre Cliente</option>
                <option value="id_product_op">Ref. Producto</option>
                <option value="created_date_customer_invoice">Fecha Factura</option>           
            </select>
            <input type="date" class="calendar" style="display: none;" name="calendar" value="" />  
            <input type="text" class="search_key input_search" id="" name="search_key" placeholder="búsqueda">
            <button type="submit" class="btn btn-primary btn_search_subwindow" id="btn_search_inputs_product" name="search"><i class="fa-solid fa-magnifying-glass icon_search_subwindow"></i></button>
        </form>
    </li>
    <li><button class="print_bar m-1 alert-info rounded" id=""><i class="fa-solid fa-print"></i>&nbspImprimir</button></li>
</ul> 