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
        //Ahora utilizamos cargar_vista_helper para generar el html del cuerpo
        return CargarVista(BASE_DIR.'/views/cuerpo.php', array( 'tituloPagina' => 'Inicio'));
    }

    public function listar(){
        //Llamamos al modelo para que nos entregue la lista de envíos
        $listaEnvios = $this->modelo->ListarEnvios();

        //Ahora utilizamos cargar_vista_helper para generar el html del cuerpo
        return CargarVista(BASE_DIR.'/views/cuerpo.php', array( 'tituloPagina' => 'Listar envíos','listaEnvios'=>$listaEnvios));
    }

    public function crear(){
        return CargarVista(BASE_DIR.'/views/cuerpo.php', array( 'tituloPagina' => 'Crear nuevo envío'));
    }

    public function editar()
    {
        return CargarVista(BASE_DIR.'/views/cuerpo.php', array( 'tituloPagina' => 'Editar envío'));
    }

    public function eliminar()
    {
        return CargarVista(BASE_DIR.'/views/cuerpo.php', array( 'tituloPagina' => 'Eliminar'));
    }

    public function anotar_recepcion()
    {
        return CargarVista(BASE_DIR.'/views/cuerpo.php', array( 'tituloPagina' => 'Anotar recepción'));
    }

    public function buscar()
    {
        return CargarVista(BASE_DIR.'/views/cuerpo.php', array( 'tituloPagina' => 'Buscar envío'));
    }
}