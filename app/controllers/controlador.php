<?php
/**
 * CONTROLADOR
 */

include_once BASE_DIR . '/models/modelo_envios.php';
include_once BASE_DIR . '/models/modelo_provincias.php';

class controlador{

    //TODO: Filtrar la información que llega de los formularios

    private $modeloEnvios;
    private $modeloProvincias;

    function __construct(){
        $this->modeloEnvios = new ModeloEnvios();
        $this->modeloProvincias = new ModeloProvincias();
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
        $listaEnvios = $this->modeloEnvios->ListarEnvios();
        foreach($listaEnvios as $id => $envio)
        {
            $provincia = $this->modeloProvincias->BuscarProvincias(array('cod_provincia' => $envio['provincia']));

            if ($provincia && count($provincia) === 1)
            {
                $listaEnvios[$id]['provincia'] = $provincia[0]['nombre'];
            }
        }


        //Ahora utilizamos cargar_vista_helper para generar el html del cuerpo
        return CargarVista(BASE_DIR.'/views/cuerpo.php', array( 'accion' => 'listar',
            'tituloPagina' => 'Listar envíos',
            'listaEnvios'=>$listaEnvios));
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