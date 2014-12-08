<?php
/**
 * CONTROLADOR FRONTAL
 */

//Inicio de sesión
session_name('app');
session_start();


//Ruta base
define('BASE_DIR', __DIR__);

// cargamos configuración y helpers
require_once BASE_DIR . '/config.php';
require_once BASE_DIR . '/helpers/carga_vista_helper.php';
require_once BASE_DIR . '/helpers/crea_form_helper.php';
require_once BASE_DIR . '/controllers/controlador_envios.php';
require_once BASE_DIR . '/controllers/controlador_usuarios.php';


//Comprobamos último acceso a la aplicación
if (isset($_SESSION['ultimo_acceso']))
{
    if (time() - $_SESSION['ultimo_acceso'] > 4)
    {
        session_unset();
        session_destroy();   // destruimos la sesión
    }
    $_SESSION['ultimo_acceso'] = time(); // actualizamos el timestamp de la última actividad

}

// enrutamiento
$map = array(
    'inicio' => array('controlador' =>'ControladorEnvios', 'accion' =>'Inicio'),
    'listar' => array('controlador' =>'ControladorEnvios', 'accion' =>'ListarEnvios'),
    'crear' => array('controlador' =>'ControladorEnvios', 'accion' =>'CrearEnvio'),
    'editar' => array('controlador' =>'ControladorEnvios', 'accion' =>'EditarEnvio'),
    'eliminar' => array('controlador'=>'ControladorEnvios','accion'=>'EliminarEnvio'),
    'buscar' => array('controlador' =>'ControladorEnvios', 'accion' =>'BuscarEnvios'),
    'anotar_recepcion' => array('controlador' =>'ControladorEnvios', 'accion' =>'AnotarRecepcion'),
    'acceder' => array('controlador' => 'ControladorUsuarios', 'accion' => 'Acceder'),
    'salir' => array('controlador' => 'ControladorUsuarios', 'accion' => 'Salir'),
    'listar_usuarios' => array('controlador' => 'ControladorUsuarios', 'accion' => 'ListarUsuarios'),
    'crear_usuario' => array('controlador' => 'ControladorUsuarios', 'accion' => 'CrearUsuario'),
    'editar_usuario' => array('controlador' => 'ControladorUsuarios', 'accion' => 'EditarUsuario'),
    'eliminar_usuario' => array('controlador' => 'ControladorUsuarios', 'accion' => 'EliminarUsuario')
);



// Parseo de la ruta
if (isset($_GET['opcion']) && isset($_SESSION['usuario']))
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
else if(isset($_SESSION['usuario']))
{
    $ruta = 'inicio';
}
else
{
    $ruta = 'acceder';
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