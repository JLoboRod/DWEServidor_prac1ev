<?php
/**
 * CONTROLADOR FRONTAL
 */
define('BASE_DIR', __DIR__);

// cargamos configuración y helpers
require_once BASE_DIR . '/config.php';
require_once BASE_DIR . '/helpers/carga_vista_helper.php';
require_once BASE_DIR . '/helpers/crea_form_helper.php';

//Procesamos la url
$ctrl = isset($_GET['ctrl'])? $_GET['ctrl'] : 'controlador';
$accion = isset($_GET['accion'])? $_GET['accion'] : 'inicio';

//Incluimos el archivo del controlador adecuado
include BASE_DIR.'/controllers/'.$ctrl.'.php';

//Creamos el controlador seleccionado
$c = new $ctrl;

//Invocamos la acción del controlador seleccionado.
//La acción utilizará el mecanismo de plantillas para
//devolver el código de la vista que genera
$htmlCuerpo = $c->{$accion}();

include BASE_DIR.'/views/plantilla.php';