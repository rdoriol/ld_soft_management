<aside class="item_main_container_nav" id="">
          <?php  
               /* Archivo php para búsqueda de página activa y marcarla en el menú lateral con fondo amarillo
                ------------------------*/
                include "000-selectetOption.php";
          ?>

      <nav class=" p-2" id="main_nav">
        <ul class="menu">
          <li class="li_item" id="">
            <button role="link" class="link_button <?php echo $home; ?>" id="index_button" onClick="window.location='index.php?pages=06-home'" title="Ir a inicio">inicio</button> <!--  DAR UNA VUELTA AL TEMA DE LINK INICIO -->
          </li>
          <li class="li_item" id="">
            <button class="link_button" id="customers_button" title="Abrir opciones clientes"><i class="fa-solid fa-caret-right"></i>&nbsp Clientes</button>
            <ul class="submenu" id="customers_submenu">
              <li class="link_subButton <?php echo $newCustomer; ?>" id="newCustomerId"><a class="" href="index.php?pages=01-newCustomer">Ficha cliente</a></li>             
              <li class="link_subButton <?php echo $customersList; ?>" id="customersListId"><a class="" href="index.php?pages=02-customersList">Listados clientes</a></li>
            </ul>
          </li>
          
          <li class="li_item" id="">
            <button class="link_button" id="suppliers_button" title="Abrir opciones proveedores"><i class="fa-solid fa-caret-right"></i>&nbsp Proveedores</button>
            <ul class="submenu" id="suppliers_submenu">
              <li class="link_subButton <?php echo $newSupplier; ?>" id="newSupplierId"><a class="" href="index.php?pages=01-newSupplier">Ficha proveedor</a></li>              
              <li class="link_subButton <?php echo $suppliersList; ?>" id="suppliersListId"><a class="" href="index.php?pages=02-suppliersList">Listas proveedores </a></li>
            </ul>
          </li>

          <li class="li_item" id="">
            <button class="link_button" id="inventory_button" title="Abrir opciones gestión inventario"> <i class="fa-solid fa-caret-right"></i>&nbsp Gestión Inventario</button>
            <ul class="submenu" id="inventory_submenu">
              <li class="link_subButton <?php echo $newProduct; ?>" id="newProductId"><a class="" href="index.php?pages=01-newProduct">Ficha producto</a></li>
              <li class="link_subButton <?php echo $productsInputs; ?>" id="productsInputsId"><a class="" href="index.php?pages=02-productsInputs">Entradas productos</a></li>
              <li class="link_subButton <?php echo $productsList; ?>" id="productsListId"><a class="" href="index.php?pages=03-productsList">Listados productos</a></li>
            </ul>
          </li>

          <li class="li_item" id="">
            <button class="link_button" id="sales_button" title="Abrir opciones ventas"><i class="fa-solid fa-caret-right"></i>&nbsp Ventas</button>
            <ul class="submenu" id="sales_submenu">
              <li class="link_subButton <?php echo $newInvoice; ?>" id="newOrderId"><a class="" href="index.php?pages=01-newInvoice">Generar facturas</a></li>             
              <li class="link_subButton <?php echo $invoicesLists; ?> id="invoicesListsId"><a class="" href="index.php?pages=02-invoicesLists">Listados facturas</a></li>
            </ul>
          </li>

          <li class="li_item" id="">
            <button class="link_button" id="employees_button" title="Abrir opciones empleados"><i class="fa-solid fa-caret-right"></i>&nbsp Empleados</button>
            <ul class="submenu" id="employees_submenu">
              <li class="link_subButton <?php echo $newEmployee; ?>" id="newEmployeeId"><a class="" href="index.php?pages=01-newEmployee">Alta empleado</a></li>
              <li class="link_subButton <?php echo $employeesList; ?>" id="employeesListId"><a class="" href="index.php?pages=02-employeesList">Listados empleados</a></li>
            </ul>
          </li>

          <li class="li_item hidden_option_menu" id=""> <!-- Opción no desarrollada ni propuesta para TFC. La implementaré más adelante -->
            <button class="link_button" id="internal_button" title="Abrir opciones gestión interna"><i class="fa-solid fa-caret-right"></i>&nbsp Gestión Interna</button>
            <ul class="submenu" id="internal_submenu">
              <li class="link_subButton <?php echo $newCustomer; ?>" id="usersId"><a class="" href="index.php?pages=00-users">Usuarios</a></li>
              <li class="link_subButton <?php echo $newCustomer; ?>" id="inventorySettingId"><a class="" href="index.php?pages=00-inventorySetting">Opciones productos </a></li>
              <li class="link_subButton <?php echo $newCustomer; ?>" id="salesSettingId"><a class="" href="index.php?pages=00-salesSetting">Opciones ventas</a></li>
            </ul>
          </li>

          <li class="li_item" id="">
            <button role="button" class="link_button text-center" id="exit_button" title="Salir">Cerrar Sesión</button> 
          </li>

        </ul>
      </nav>   

    </aside>

                <!-- mobile nav bar
                    ----------------->

       <img src="./images/menu/menu_open.png" class="mobile_menu" id="" title="Menú" alt="icon_menu" />

