<h2 class="li_active_page rounded">Listados Facturas</h2>

<h4 class="forms_subtitle rounded">Buscar Facturas</h4>

        <!-- SEARCH BAR
            ---------------------->

        <?php  include "03-invoiceSearchBar.template.php"; ?>

        <!-- end search bar -------->

<table class="general_tables table table-striped text-center" id="products_lists_table">
    <thead>
        <tr>
            <th>Fecha</th><th>Nº Factura</th><th>Nº Cliente</th><th>Cliente</th><th>Subtotal sin Impuestos (€)</th><th>Total Factura (€)</th>
        </tr>
        </thead>
        <tbody>
            <?php 
                
                $key = $_POST["select_item"];
                $value = $_POST["search_key"];

                $dataInvoice = SalesController::ctrToListOutputsProducts("customer_invoices", $key, $value);  // Consulta a la tabla "customer_invoices"
                

                foreach($dataInvoice as $itemInvoice):                  
            ?>
            <tr>
                <td> <?php echo $itemInvoice->created_date_customer_invoice; ?> </td>
                <td> <?php echo $itemInvoice->output_number; ?> </td>
                <td> <?php echo $itemInvoice->id_customer_ci; ?> </td>
                <td> <?php echo $itemInvoice->name_customer; ?> </td>
                <td> <?php echo $itemInvoice->subtotal_with_discount_invoice; ?> </td>
                <td> <?php echo $itemInvoice->total_invoice; ?> </td>                
                <td>
                    <a href="index.php?pages=01-newInvoice&token=<?php echo $itemInvoice->token_customer_invoice; ?>" class="btn btn-warning m-1" title="Ver Factura"><i class="fa-sharp fa-solid fa-pencil"></i></a>
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