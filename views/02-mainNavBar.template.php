<aside class="item_main_container" id="">
      
      <nav class="item_main_container_nav p-2" id="main_nav">
        <ul class="menu">
          <li class="li_item" id="">
            <button role="link" class="link_button" id="index_button" onClick="window.location='index.php'">inicio</button> <!--  DAR UNA VUELTA AL TEMA DE LINK INICIO -->
          </li>
          <li class="li_item" id="">
            <button class="link_button" id="customers_button" title="Abrir opciones clientes"><i class="fa-solid fa-caret-right"></i>&nbsp Clientes</button>
            <ul class="submenu" id="customers_submenu">
              <li class="link_subButton"><a class="" id="newCustomerId" href="index.php?pages=01-newCustomer">Alta cliente</a></li>
              <li class="link_subButton"><a class="" id="customerFileId" href="index.php?pages=02-customerFile">Ficha cliente</a></li>
              <li class="link_subButton"><a class="" id="customersListId" href="index.php?pages=04-customersList">Listado clientes</a></li>
            </ul>
          </li>
          
          <li class="li_item" id="">
            <button class="link_button" id="suppliers_button" title="Abrir opciones proveedores"><i class="fa-solid fa-caret-right"></i>&nbsp Proveedores</button>
            <ul class="submenu" id="suppliers_submenu">
              <li class="link_subButton"><a class="" id="newSupplierId" href="index.php?pages=01-newSupplier">Alta proveedor</a></li>
              <li class="link_subButton"><a class="" id="supplierFileId" href="index.php?pages=02-supplierFile">Ficha proveedor</a></li>
              <li class="link_subButton"><a class="" id="suppliersListId" href="index.php?pages=04-suppliersList">Listado proveedores</a></li>
            </ul>
          </li>

          <li class="li_item" id="">
            <button class="link_button" id="inventory_button" title="Abrir opciones gestión inventario"> <i class="fa-solid fa-caret-right"></i>&nbsp Gestión Inventario</button>
            <ul class="submenu" id="inventory_submenu">
              <li class="link_subButton"><a class="" id="newProductId" href="index.php?pages=01-newProduct">Alta producto</a></li>
              <li class="link_subButton"><a class="" id="productFileId" href="index.php?pages=02-productFile">Ficha producto</a></li>
              <li class="link_subButton"><a class="" id="productsInputsId" href="index.php?pages=04-productsInputs">Entradas productos</a></li>
              <li class="link_subButton"><a class="" id="productsListId" href="index.php?pages=05-productsList">Listado productos</a></li>
            </ul>
          </li>

          <li class="li_item" id="">
            <button class="link_button" id="sales_button" title="Abrir opciones ventas"><i class="fa-solid fa-caret-right"></i>&nbsp Ventas</button>
            <ul class="submenu" id="sales_submenu">
              <li class="link_subButton"><a class="" id="newOrderId" href="index.php?pages=01-newOrder">Alta pedido</a></li>
              <li class="link_subButton"><a class="" id="notesId" href="index.php?pages=02-notes">Albaranes</a></li>
              <li class="link_subButton"><a class="" id="invoiceId" href="index.php?pages=03-invoice">Facturas</a></li>
              <li class="link_subButton"><a class="" id="proInvoiceId" href="index.php?pages=04-proInvoice">Facturas proforma</a></li>
              <li class="link_subButton"><a class="" id="budgetsId" href="index.php?pages=05-budgets">Presupuestos</a></li>
              <li class="link_subButton"><a class="" id="salesListsId" href="index.php?pages=06-salesLists">Listado ventas</a></li>
            </ul>
          </li>

          <li class="li_item" id="">
            <button class="link_button" id="employees_button" title="Abrir opciones empleados"><i class="fa-solid fa-caret-right"></i>&nbsp Empleados</button>
            <ul class="submenu" id="employees_submenu">
              <li class="link_subButton"><a class="" id="newEmployeeId" href="index.php?pages=01-newEmployee">Alta empleado</a></li>
              <li class="link_subButton"><a class="" id="employeeFileId" href="index.php?pages=02-employeeFile">Ficha empleado</a></li>
              <li class="link_subButton"><a class="" id="employeesListId" href="index.php?pages=04-employeesList">Listado empleados</a></li>
            </ul>
          </li>

          <li class="li_item" id="">
            <button class="link_button" id="internal_button" title="Abrir opciones gestión interna"><i class="fa-solid fa-caret-right"></i>&nbsp Gestión Interna</button>
            <ul class="submenu" id="internal_submenu">
              <li class="link_subButton"><a class="" id="usersId" href="index.php?pages=00-users">Usuarios</a></li>
              <li class="link_subButton"><a class="" id="inventorySettingId" href="index.php?pages=00-inventorySetting">Opciones productos </a></li>
              <li class="link_subButton"><a class="" id="salesSettingId" href="index.php?pages=00-salesSetting">Opciones ventas</a></li>
            </ul>
          </li>

        </ul>
      </nav>   

    </aside>

                <!-- mobile nav bar
                    ----------------->

    <div class="mobile_menu">
      <button title="Menú"><i class="fa-solid fa-bars fa-2xl" style="color: #007bff;"></i></button>
        <nav>
        </nav>
    </div>
                <!-- end mobile nav bar -->
