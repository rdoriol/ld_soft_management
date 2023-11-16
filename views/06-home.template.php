<?php
        // Condición para verificar que se ha iniciado sesión de forma correcta 
    if(!isset($_SESSION["loginCheck"])) {
        header("location: index.php");
        exit;   
    }
    else {
        if($_SESSION["loginCheck"]  != "ok") {
            header("location: index.php");
            exit;
        }
    }                                     
?>

<h2 class="li_active_page rounded" id="home_title">Inicio</h2>

<div class="grid_home" id="home">

    <div class="grid_container">
        <img src="./images/home/customers.png" title="gestion_clientes" />
        <h5>Clientes</h5>
        <ul>
            <li><a href="index.php?pages=01-newCustomer">Ficha cliente</a></li>
            <li><a href="index.php?pages=02-customersList">Listados clientes</a></li>
        </ul>
    </div>

    <div class="grid_container">
        <img src="./images/home/suppliers.png" title="gestion_clientes" />
        <h5>Proveedores</h5>
        <ul>
            <li><a href="index.php?pages=01-newSupplier">Ficha proveedores</a></li>
            <li><a href="index.php?pages=02-suppliersList">Listas proveedores</a></li>
        </ul>
    </div>

    <div class="grid_container">
        <img src="./images/home/inventory.png" title="gestion_clientes" />
        <h5>Gestión Inventario</h5>
        <ul>
            <li><a href="index.php?pages=01-newProduct">Ficha producto</a></li>
            <li><a href="index.php?pages=02-productsInputs">Entradas productos</a></li>
            <li><a href="index.php?pages=03-productsList">Lstados productos</a></li>
            
        </ul>
    </div>

    <div class="grid_container">
        <img src="./images/home/invoice.png" title="gestion_clientes" />
        <h5>Ventas</h5>
        <ul>
            <li><a href="index.php?pages=01-newInvoice">Generar facturas</a></li>
            <li><a href="index.php?pages=02-invoicesLists">Listados facturas</a></li>
        </ul>
    </div>

    <div class="grid_container">
        <img src="./images/home/employees.png" title="gestion_clientes" />
        <h5>Empleados</h5>
        <ul>
            <li><a href="index.php?pages=01-newEmployee">Alta empleado</a></li>
            <li><a href="index.php?pages=02-employeesList">Listados empleados</a></li>
        </ul>
    </div>

    <div class="grid_container">
        <img src="./images/home/warning.png" title="gestion_clientes" />
        <h5>Incidencias</h5>
        <ul> 
            <li style="color:gold;">Contactar <a href="#">901 253 654</a></li>
            <li><a href="mailto:soporte@ldsoft.es">soporte@ldsoft.es</a></li>
        </ul>
    </div>

    <div class="grid_container">
        <img src="./images/home/session_close.png" title="gestion_clientes" />
        <h5>Cerrar Sesión</h5>
        <ul> 
            <li><a id="session_close_home">Cerrar</a></li>
        </ul>
    </div>











</div> <!-- end class="grid_home">