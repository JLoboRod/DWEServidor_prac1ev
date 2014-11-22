<?php
/**
 * CONTROLADOR
 */

include_once BASE_DIR.'/models/modelo.php';

class controlador{

    //TODO: Filtrar la información que llega de los formularios

    private $modelo;

    function __construct(){
        $this->modelo = new Modelo();
    }

    /**
     * Función inicio que se ejecuta por defecto
     * @return string
     */
    public function inicio(){
        return '<p>Inicio</p>';
    }

    public function listar(){
        //Llamamos al modelo para que nos entregue la lista de envíos
        $listaEnvios = $this->modelo->ListarEnvios();

        //Ahora utilizamos cargar_vista_helper para generar el html del cuerpo
        return CargarVista(BASE_DIR.'/views/cuerpo.php', array('listaEnvios'=>$listaEnvios));
    }

    public function editar()
    {
        return '<p>Editar</p>';
    }

    public function eliminar()
    {
        return '<p>Eliminar</p>';
    }

    public function anotar_recepcion()
    {
        return '<p>Anotar recepción</p>';
    }

    public function buscar()
    {
        return '<p>Buscar</p>';
    }
}