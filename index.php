<?php
    /**
    * Fichero principal que renderizará por pantalla la plantilla base junto con las distintas páginas.
    */

    require_once "./controllers/baseTemplate.controller.php";

    $render = new BaseTemplateController();
    $render->ctrGetBaseTemplate();



// Por motivos de seguridad informática no se cierra etiqueta php