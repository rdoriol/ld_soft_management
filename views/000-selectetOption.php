<?php
        //array asociativo para marcar fondo en amarillo de los submenús de la barra de navegación lateral
    
    $active = "link_subButton_active";  // Variable con cadena de texto que corresponde a una clase que se añadirá a etiqueta del subbutón para que tome propiedades css (background-color yellow)

    if(isset($_GET["pages"])) {
            
        $page = $_GET["pages"]; // Se almacena página activa        
    
        switch ($page) {
            case "01-newCustomer":
                $newCustomer = $active;
                break;
            case "02-customersList":
                $customersList = $active;
                break;
            case "01-newSupplier":
                $newSupplier = $active;
                break;
            case "02-suppliersList":
                $suppliersList = $active;
                break;
            case "01-newProduct":
                $newProduct = $active;
                break;
            case "02-productsInputs":
                $productsInputs = $active;
                break;
            case "03-productsList":
                $productsList = $active;
                break;
            case "01-newInvoice":
                $newInvoice = $active;
                break;
            case "02-invoicesLists":
                $invoicesLists = $active;
                break;
            case "01-newEmployee":
                $newEmployee = $active;
                break;           
            case "02-employeesList":
                $employeesList = $active;
                break;
            case "06-home":
                $home = "li_active_button"; // Botón inicio, diferente al resto
                break;           
            default:
                return;
        }








    }