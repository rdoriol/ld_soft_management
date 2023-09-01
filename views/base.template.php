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
              <button role="link" class="link_item" onClick="window.location='index.php'">Inicio</button> <!--  DARLE UNA VUELTA AL TEMA DE LINK INICIO -->
            </li>
            <li class="li_item" id="menu_title">
              <button class="link_item" title="Abrir opciones clientes">Clientes <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="index.php?pages=01.newCustomer">Alta cliente</a></li>
                <li class=""><a class="" href="index.php?pages=02.customerFile">Ficha cliente</a></li>
                <li class=""><a class="" href="index.php?pages=04.customersList">Listado clientes</a></li>
              </ul>
            </li>
            
            <li class="li_item"id="menu_title">
              <button class="link_item">Proveedores <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="index.php?pages=01.newSupplier">Alta proveedor</a></li>
                <li class=""><a class="" href="index.php?pages=02.supplierFile">Ficha proveedor</a></li>
                <li class=""><a class="" href="index.php?pages=04.suppliersList">Listado proveedores</a></li>
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
                <li class=""><a class="" href="index.php?pages=01newOrder">Alta pedido</a></li>
                <li class=""><a class="" href="index.php?pages=02notes">Albaranes</a></li>
                <li class=""><a class="" href="index.php?pages=03invoice">Facturas</a></li>
                <li class=""><a class="" href="index.php?pages=04proInvoice">Facturas proforma</a></li>
                <li class=""><a class="" href="index.php?pages=05budgets">Presupuestos</a></li>
                <li class=""><a class="" href="index.php?pages=06salesLists">Listado ventas</a></li>
              </ul>
            </li>

            <li class="li_item"id="menu_title">
              <button class="link_item">Empleados <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="#">Alta empleado</a></li>
                <li class=""><a class="" href="#">Ficha empleado</a></li>
                <li class=""><a class="" href="#">Listado empleados</a></li>
              </ul>
            </li>

            <li class="li_item"id="menu_title">
              <button class="link_item">Gestión Interna <i class="fa-solid fa-caret-down"></i></button>
              <ul class="submenu">
                <li class=""><a class="" href="#">Usuarios</a></li>
                <li class=""><a class="" href="#">Configuración productos </a></li>
                <li class=""><a class="" href="#">Configuración ventas</a></li>
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
                   * Lista blanca de páginas (seguridad informática) de la aplicación web que se renderizarán por pantalla.
                   */
                if(isset($_GET["pages"])) 
                {
                  $page = $_GET["pages"]; // variable que almacena el valor de la variable GET

                  if($page == "01.newCustomer" ||$page == "02.customerFile" || $page == "04.customersList") 
                  {
                    include "pages/01.customers/" . $page . ".template.php";
                  }
                  else if($page == "01.newSupplier" || $page == "02.supplierFile" || $page == "04.suppliersList")
                  {
                    include "pages/02.suppliers/" . $page . ".template.php";
                  }
                  else if($page == "01-newProduct" || $page == "02-productFile" || $page == "04-productsInputs" || $page == "05-productsList")
                  {
                    include "pages/03.inventary/" . $page . ".template.php";
                  }
                  else if($page == "01newOrder" || $page == "02notes" || $page == "03invoice"  || $page == "04proInvoice" || $page == "05budgets"  || $page == "06salesLists")
                  {
                    include "pages/04.sales/" . $page . ".template.php";
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