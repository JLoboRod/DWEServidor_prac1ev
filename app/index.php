<?php
/**
 * CONTROLADOR FRONTAL
 */
define('BASE_DIR', __DIR__);

// cargamos configuración y helpers
require_once BASE_DIR . '/config.php';
require_once BASE_DIR . '/helpers/carga_vista_helper.php';
require_once BASE_DIR . '/helpers/crea_form_helper.php';
require_once BASE_DIR . '/controllers/controlador_envios.php';

// enrutamiento
$map = array(
    'inicio' => array('controlador' =>'ControladorEnvios', 'accion' =>'Inicio'),
    'listar' => array('controlador' =>'ControladorEnvios', 'accion' =>'ListarEnvios'),
    'crear' => array('controlador' =>'ControladorEnvios', 'accion' =>'CrearEnvio'),
    'editar' => array('controlador' =>'ControladorEnvios', 'accion' =>'EditarEnvio'),
    'eliminar' => array('controlador'=>'ControladorEnvios','accion'=>'EliminarEnvio'),
    'buscar' => array('controlador' =>'ControladorEnvios', 'accion' =>'BuscarEnvios'),
    'anotar_recepcion' => array('controlador' =>'ControladorEnvios', 'accion' =>'AnotarRecepcion')
);

// Parseo de la ruta
if (isset($_GET['opcion']))
{
    if (isset($map[$_GET['opcion']]))
    {
        $ruta = $_GET['opcion'];
    }
    else
    {
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
            $_GET['opcion'] .
            '</p></body></html>';
        exit;
    }
}
else
{
    $ruta = 'inicio';
}

$controlador = $map[$ruta]['controlador'];
$accion = $map[$ruta]['accion'];
// Ejecución del controlador asociado a la ruta

$c = new $controlador;
if(!$htmlCuerpo = $c->{$accion}())
{
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador .
        '->' .
        $accion .
        '</i> no existe</h1></body></html>';
}

include BASE_DIR.'/views/plantilla.php';