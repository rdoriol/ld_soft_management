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
      <section class="item_main_container item_main_container_section container-fluid py-5" id="main_container_section">
          
        <div class="text-center container" id="">
          <?php
              /**
               * Controlador frontal/lista blanca de todas las páginas (seguridad informática) de la aplicación web que se renderizarán por pantalla. (se alimenta de "02-mainNavBar.template.php").
               */
            if(isset($_GET["pages"])) 
            {
              $page = $_GET["pages"]; // variable que almacena el valor de la variable GET

              if($page == "01-newCustomer" || $page == "02-customerFile" || $page == "04-customersList") 
              {
                include "pages/01.customers/" . $page . ".template.php";
              }
              else if($page == "01-newSupplier" || $page == "02-supplierFile" || $page == "04-suppliersList")
              {
                include "pages/02.suppliers/" . $page . ".template.php";
              }
              else if($page == "01-newProduct" || $page == "02-productFile" || $page == "04-productsInputs" || $page == "05-productsList")
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

    <script src="js/mainNavBar.js"></script>

  </body>
</html>