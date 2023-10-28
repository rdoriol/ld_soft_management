<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login - LD Soft Gestión</title>
    
    <!-- RESET CSS DE NAVEGADORES
        ---------------------->
    <style>@import url("./css/syles_reset.css");</style>

    <!-- PLUGINS CSS 
        ---------------------->
                <!-- BOOTSTRAP - Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- CSS PERSONALIZADO
        ---------------------->
    <style>@import url("./css/styles.css");</style>

    <!-- PLUGINS JS 
        ---------------------->
                <!-- BOOTSTRAP - jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>

                <!-- BOOTSTRAP - Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

                <!-- BOOTSTRAP - Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> 
            
                <!-- FONTAWESOME - icons-->
    <script src="https://kit.fontawesome.com/9151328e30.js" crossorigin="anonymous"></script>
    
</head>
<body>
                                                 
            <!-- HEADER
                 ---------------------->
    <?php include "01-header.template.php"; ?>

            <!-- end header ------------>

    <main class="main_container">

            <!-- MAIN NAVIGATION BAR 
                 ----------------------->
      <?php include "02-mainNavBar.template.php"; ?>

            <!-- end main navigation bar -->

            <!-- CENTRAL MAIN CONTAINER
                 ------------------------>
      <section class="item_main_container item_main_container_section" id="main_container_section">

        <div class="text-center container" id="">   
                       
            <!-- DELETE REGISTER MODAL
                 ----------------------->
              <?php include "05-modalDeleteRegister.template.php"; ?>

            <!-- end delete register modal -->  

          <?php
              /**
               * Controlador frontal/lista blanca de todas las páginas (seguridad informática) de la aplicación web que se renderizarán por pantalla. (se alimenta de "02-mainNavBar.template.php").
               */
            if(isset($_GET["pages"]) /*|| isset($_GET["emergent"])*/) 
            {
              $page = $_GET["pages"]; // variable que almacena el valor de la variable GET
              //$emergent = $_GET["emergent"]; // variable que almacena el valor de la variable GET

              if($page == "01-newCustomer" || $page == "02-customersList" || $page == "04-customerPopUpSearch") 
              {
                include "pages/01.customers/" . $page . ".template.php";     
              }
              else if($page == "01-newSupplier" || $page == "02-suppliersList" || $page == "04-supplierPopUpSearch")
              {
                include "pages/02.suppliers/" . $page . ".template.php";
              }
              else if($page == "01-newProduct" || $page == "02-productsInputs" || $page == "03-productsList" || $page == "05-inventoryPopUpSearch")
              {
                include "pages/03.inventory/" . $page . ".template.php";
              }
              else if($page == "01-newOrder" || $page == "02-notes" || $page == "03-invoice"  || $page == "04-proInvoice" || $page == "05-budgets"  || $page == "06-salesLists")
              {
                include "pages/04.sales/" . $page . ".template.php";
              }
              else if($page == "01-newEmployee" || $page == "02-employeeFile" || $page == "04-employeesList")
              {
                include "pages/05.employees/" . $page . ".template.php";
              }
              else if($page == "00-users") // TODO añadir restos de páginas en lista blanca y enlaces correspondientes
              {
                include "pages/06.users/" . $page . ".template.php";
              }
              else if($page == "00-inventorySetting") 
              {
                include "pages/07.inventorySetting/" . $page . ".template.php";
              }
              else if($page == "00-salesSetting")
              {
                include "pages/08.salesSetting/" . $page . ".template.php";
              }
              /*else if($emergent == "06-popUpsearch")
              {
                include $emergent . ".template.php";
              }*/
              else
              {
                include "04-error404.template.php";
              }                    
            }
            else
            {
              echo "Panel principal aplicación web ERP";
            }
          ?>
        </div>

      </section>
            <!-- end central main container --> 

    </main>

    
             <!-- FOOTER
                 ------------------------> 
    <?php include "03-footer.template.php"; ?>

            <!-- end footer -------------->

    <script src="./js/mainNavBar.js"></script>

    <script src="./views/pages/01.customers/05-customers.js"></script>
    <script src="./views/pages/01.customers/06-customers_validations.js"></script>
    <script src="./views/pages/01.customers/07-customers_prints.js"></script>

    <script src="./views/pages/02.suppliers/05-suppliers.js"></script>
    <script src="./views/pages/02.suppliers/06-suppliers_validations.js"></script>
    <script src="./views/pages/02.suppliers/07-suppliers_prints.js"></script>

    <script src="./views/pages/03.inventory/06-inventory.js"></script>
    <script src="./views/pages/03.inventory/07-inventory_validations.js"></script>   
    <script src="./views/pages/03.inventory/08-products_inputs.js"></script>    
    <script src="./views/pages/03.inventory/09-inventory_prints.js"></script>

  </body>
</html>