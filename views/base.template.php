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
            
                <!-- FONTAWESOME - iconos-->
    <script src="https://kit.fontawesome.com/9151328e30.js" crossorigin="anonymous"></script>
    
</head>
<body>

            <!--HEADER
---------------------------->

    <header class="container-fluid" id="">
        <h1 class="text-center">Base Template - LOGO</h1>
    </header>

    <main class="main_container">

            <!-- MAIN NAVIGATION BAR 
---------------------------->
      
      <aside class="item_main_container" id="">
      
        <nav class="item_main_container_nav p-2" id="main_nav">
          <ul class="menu">
            <li class="li_item" id="menu_title">
              <button role="link" class="link_item" onClick="window.location='index.php'">Inicio</button> <!--  DAR UNA VUELTA AL TEMA DE LINK INICIO -->
            </li>
            <li class="li_item" id="menu_title">
              <button class="link_item" title="Abrir opciones clientes">Clientes <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="index.php?pages=01-newCustomer">Alta cliente</a></li>
                <li class=""><a class="" href="index.php?pages=02-customerFile">Ficha cliente</a></li>
                <li class=""><a class="" href="index.php?pages=04-customersList">Listado clientes</a></li>
              </ul>
            </li>
            
            <li class="li_item"id="menu_title">
              <button class="link_item">Proveedores <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="index.php?pages=01-newSupplier">Alta proveedor</a></li>
                <li class=""><a class="" href="index.php?pages=02-supplierFile">Ficha proveedor</a></li>
                <li class=""><a class="" href="index.php?pages=04-suppliersList">Listado proveedores</a></li>
              </ul>
            </li>

            <li class="li_item"id="menu_title">
              <button class="link_item">Gestión Inventario <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="index.php?pages=01-newProduct">Alta producto</a></li>
                <li class=""><a class="" href="index.php?pages=02-productFile">Ficha producto</a></li>
                <li class=""><a class="" href="index.php?pages=04-productsInputs">Entradas productos</a></li>
                <li class=""><a class="" href="index.php?pages=05-productsList">Listado productos</a></li>
              </ul>
            </li>

            <li class="li_item"id="menu_title">
              <button class="link_item">Ventas <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="index.php?pages=01-newOrder">Alta pedido</a></li>
                <li class=""><a class="" href="index.php?pages=02-notes">Albaranes</a></li>
                <li class=""><a class="" href="index.php?pages=03-invoice">Facturas</a></li>
                <li class=""><a class="" href="index.php?pages=04-proInvoice">Facturas proforma</a></li>
                <li class=""><a class="" href="index.php?pages=05-budgets">Presupuestos</a></li>
                <li class=""><a class="" href="index.php?pages=06-salesLists">Listado ventas</a></li>
              </ul>
            </li>

            <li class="li_item"id="menu_title">
              <button class="link_item">Empleados <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="index.php?pages=01-newEmployee">Alta empleado</a></li>
                <li class=""><a class="" href="index.php?pages=02-employeeFile">Ficha empleado</a></li>
                <li class=""><a class="" href="index.php?pages=04-employeesList">Listado empleados</a></li>
              </ul>
            </li>

            <li class="li_item"id="menu_title">
              <button class="link_item">Gestión Interna <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="index.php?pages=00-users">Usuarios</a></li>
                <li class=""><a class="" href="index.php?pages=00-inventorySetting">Configuración productos </a></li>
                <li class=""><a class="" href="index.php?pages=00-salesSetting">Configuración ventas</a></li>
              </ul>
            </li>

          </ul>
        </nav>   

      </aside>
            <!-- MOBILE MENU
---------------------------->

      <div class="mobile_menu">
      <button title="Menú"><i class="fa-solid fa-bars fa-2xl" style="color: #007bff;"></i></button>
        <nav>
        </nav>
      </div>

            <!-- CENTRAL MAIN CONTAINER
---------------------------------------->
      <!--
      <div class="item_main_container item_main_container_section" id="main_container_section">
-->
        <section class="item_main_container item_main_container_section container-fluid py-5" id="main_container_section">
            
            <div class="text-center container" id="">
              <?php
                  /**
                   * Controlador frontal o Lista blanca de todas las páginas (seguridad informática) de la aplicación web que se renderizarán por pantalla.
                   */
                if(isset($_GET["pages"])) 
                {
                  $page = $_GET["pages"]; // variable que almacena el valor de la variable GET

                  if($page == "01-newCustomer" ||$page == "02-customerFile" || $page == "04-customersList") 
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
                    echo "error 404";
                  }                    
                }
                else
                {
                  echo "Panel principal aplicación web ERP";
                }
              ?>
            </div>

        </section>

    </main>

            <!-- FOOTER
---------------------------->
    <footer class="" id="">
        <h3>footer</h3>
    </footer>

    <script src="js/mainNav.js"></script>

  </body>
</html>