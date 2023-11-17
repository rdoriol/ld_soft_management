<?php
    /** 
     * Variable que contralará que nadie aacceda directamente a un fichero php interno
    */
    const CON_CONTROLADOR = 1;

    /**
    * Fichero principal que renderizará por pantalla la plantilla base junto con las distintas páginas.
    */
 

    require_once "./controllers/baseTemplate.controller.php";
    require_once "./controllers/validations_general.controller.php";
    require_once "./controllers/01-customers.controller.php";
    require_once "./controllers/02-suppliers.controller.php";
    require_once "./controllers/03-inventory.controller.php";    
    require_once "./controllers/04-inventory_validations.controller.php";
    require_once "./controllers/05-products_inputs_inventory.controller.php";
    require_once "./controllers/06-sales.controller.php";
    require_once "./controllers/10-users.controller.php";    

    require_once "./models/01-customers.model.php";
    require_once "./models/02-suppliers.model.php";
    require_once "./models/03-inventory.model.php";
    require_once "./models/04-products_inputs_inventory.model.php";
    require_once "./models/05-sales.model.php";
    require_once "./models/10-users.model.php";
   
    $render = new BaseTemplateController();
    $render->ctrGetBaseTemplate();



// Por motivos de seguridad informática no se cierra etiqueta php


