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
        return CargarVista(BASE_DIR.'/views/cuerpo.php',
            array(
                'accion' => 'inicio',
                'tituloPagina' => 'Inicio'
            ));
    }

    /**
     * Functión que trata el evento de listar envíos
     * @return string
     */
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
        return CargarVista(BASE_DIR.'/views/cuerpo.php',
            array(
                'accion' => 'listar',
                'tituloPagina' => 'Listar envíos',
                'listaEnvios'=>$listaEnvios
            ));
    }

    /**
     * Función que trata el evento de crear envío
     * @return string
     */
    public function crear(){
        $listaProvincias = $this->modeloProvincias->ListarProvincias();

        if($_POST)
        {

            /**
             * FILTRADO --> TODO: Falta filtrar la informaciónen crear. En principio suponemos que no hay problemas
             */


            //Añadimos la fecha de creación: Se debe crear automáticamente sin que el usuario la introduzca
            $_POST['fecha_crea'] = date('Y-m-d');
            $this->modeloEnvios->CrearEnvio($_POST);
            return CargarVista(BASE_DIR . '/views/cuerpo.php',
                array(
                    'accion' => 'crear',
                    'tituloPagina' => 'Crear nuevo envío',
                    'confirmacion' => 'Envío creado correctamente'
                ));

        }
        else {

            $provincias = [];

            foreach ($listaProvincias as $id => $provincia) {
                $provincias[] = $provincia['nombre'];
            }

            return CargarVista(BASE_DIR . '/views/cuerpo.php',
                array(
                    'accion' => 'crear',
                    'tituloPagina' => 'Crear nuevo envío',
                    'listaProvincias' => $listaProvincias
                ));
        }
    }

    public function editar()
    {
        return CargarVista(BASE_DIR.'/views/cuerpo.php',
            array(
                'accion' => 'editar',
                'tituloPagina' => 'Editar envío'
            ));
    }

    public function eliminar()
    {
        return CargarVista(BASE_DIR.'/views/cuerpo.php',
            array(
                'accion' => 'eliminar',
                'tituloPagina' => 'Eliminar'
            ));
    }

    public function anotar_recepcion()
    {
        return CargarVista(BASE_DIR.'/views/cuerpo.php',
            array(
                'accion' => 'anotar_recepcion',
                'tituloPagina' => 'Anotar recepción'
            ));
    }

    public function buscar()
    {
        return CargarVista(BASE_DIR.'/views/cuerpo.php',
            array(
                'accion' => 'buscar',
                'tituloPagina' => 'Buscar envío'
            ));
    }
}