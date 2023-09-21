<?php
    /**
    * Fichero principal que renderizará por pantalla la plantilla base junto con las distintas páginas.
    */

    require_once "./controllers/baseTemplate.controller.php";
    require_once "./controllers/01-customers.controller.php";
    require_once "./controllers/validations.controller.php";

    require_once "./models/01-customers.model.php";
   
    $render = new BaseTemplateController();
    $render->ctrGetBaseTemplate();



// Por motivos de seguridad informática no se cierra etiqueta php