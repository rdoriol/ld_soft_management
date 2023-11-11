<?php
        //array asociativo para marcar fondo en amarillo de los submenús de la barra de navegación lateral

    $optionsNav = array("01-newCustomer"=> $newCustomer."='';", "02-customersList"=> $customersList, 
                        "01-newSupplier"=> $newSupplier, "02-suppliersList"=> $suppliersList,
                        "01-newProduct"=> $newProduct, "02-productsInputs"=> $productsInputs, "03-productsList"=> $productsList,
                        "01-newInvoice"=> $newInvoice, "02-invoicesLists"=> $invoicesLists,
                        "01-newEmployee"=> $newEmployee, "02-employeeFile"=> $employeeFile, "03-employeesList"=> $employeesList,
                        "06-home" => $home
                        );

    foreach($optionsNav as $key=> $value) { 
        if(isset($_GET["pages"])){
            if($_GET["pages"] == $key) {                
                $value = "link_subButton_active";
           
            }            
        }  
    }  echo $newCustomer;


?>