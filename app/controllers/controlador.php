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
                    'mensaje' => 'Envío creado correctamente'
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

    /**
     * Función que trata el evento de editar envío
     * @return string
     */
    public function editar()
    {

        if($_POST)
        {
            /**
             * FILTRADO --> TODO: Falta filtrar la el cod_envio (Si no está vacío y si existe en la base de datos). En principio suponemos que no hay problemas
             */

            if(count($_POST)===1 && isset($_POST['cod_envio'])) //Si SÓLO hemos especificado el cod_envio y si existe dicho envío...
            {
                $datosEnvio = $this->modeloEnvios->BuscarEnvios(array('cod_envio' => $_POST['cod_envio']));

                $listaProvincias = $this->modeloProvincias->ListarProvincias();

                //Mostramos el formulario de edición de envío
                return CargarVista(BASE_DIR.'/views/cuerpo.php',
                    array(
                        'accion' => 'editar',
                        'tituloPagina' => 'Editar envío',
                        'datosEnvio' => $datosEnvio[0],
                        'listaProvincias' => $listaProvincias
                    ));

            }
            else //Hemos especificado más datos -> venimos del formulario de edición
            {
                /**
                 * FILTRADO --> TODO: Falta filtrar la información en editar. En principio suponemos que no hay problemas
                 */

                echo '<pre>';
                print_r($_POST);
                echo '</pre>';

                $this->modeloEnvios->EditarEnvio($_POST['cod_envio'], $_POST);
                return CargarVista(BASE_DIR . '/views/cuerpo.php',
                    array(
                        'accion' => 'editar',
                        'tituloPagina' => 'Editar envío',
                        'mensaje' => 'Envío modificado correctamente'
                    ));


            }

        }
        else {  //Mostramos el formulario de elección de pedido

            return CargarVista(BASE_DIR . '/views/cuerpo.php',
                array(
                    'accion' => 'editar',
                    'tituloPagina' => 'Editar envío'
                ));

        }

    }

    /**
     * Función que trata el evento de eliminar envío
     * @return string
     */
    public function eliminar()
    {
        if($_POST)
        {

            if(count($_POST)===1 && isset($_POST['cod_envio']))
            {
                /**
                 * FILTRADO --> TODO: Falta filtrar la el cod_envio (Si no está vacío y si existe en la base de datos). En principio suponemos que no hay problemas
                 */

                if($this->modeloEnvios->BuscarEnvios(array('cod_envio' => $_POST['cod_envio']))) {

                    $this->modeloEnvios->EliminarEnvio($_POST['cod_envio']);
                    return CargarVista(BASE_DIR . '/views/cuerpo.php',
                        array(
                            'accion' => 'eliminar',
                            'tituloPagina' => 'Eliminar envío',
                            'mensaje' => 'Envío eliminado correctamente.'
                        ));
                }
                else
                {
                    return CargarVista(BASE_DIR . '/views/cuerpo.php',
                        array(
                            'accion' => 'eliminar',
                            'tituloPagina' => 'Eliminar envío',
                            'mensaje' => 'Error al eliminar el envío.'
                        ));
                }
            }
        }
        else
        {
            return CargarVista(BASE_DIR . '/views/cuerpo.php',
                array(
                    'accion' => 'eliminar',
                    'tituloPagina' => 'Eliminar envío'
                ));
        }
    }

    /**
     * Función que trata el evento de anotar recepción de un envío
     * @return string
     */
    public function anotar_recepcion()
    {
        return CargarVista(BASE_DIR.'/views/cuerpo.php',
            array(
                'accion' => 'anotar_recepcion',
                'tituloPagina' => 'Anotar recepción'
            ));
    }

    /**
     * Función que trata el evento de buscar envío
     * @return string
     */
    public function buscar()
    {
        if($_POST)
        {
            //Preparamos los criterios de búsqueda
            $datos = [];

            foreach($_POST as $clave => $valor)
            {
                if($valor) //Sólo tendremos en cuenta los campos que el usuario complete
                {
                    $datos[$clave] = $valor;
                }
            }

            $listaEnvios = $this->modeloEnvios->BuscarEnvios($datos);

            if($listaEnvios)
            {
                //Cambiamos cod_provincia por el nombre
                foreach ($listaEnvios as $id => $envio) {
                    $provincia = $this->modeloProvincias->BuscarProvincias(array('cod_provincia' => $envio['provincia']));

                    if ($provincia && count($provincia) === 1) {
                        $listaEnvios[$id]['provincia'] = $provincia[0]['nombre'];
                    }
                }

                return CargarVista(BASE_DIR.'/views/cuerpo.php',
                    array(
                        'accion' => 'buscar',
                        'tituloPagina' => 'Buscar envíos',
                        'listaEnvios' => $listaEnvios
                    ));
            }
            else
            {
                return CargarVista(BASE_DIR.'/views/cuerpo.php',
                    array(
                        'accion' => 'buscar',
                        'tituloPagina' => 'Buscar envíos',
                        'mensaje' => 'No hay envíos que cumplan esas condiciones.'
                    ));
            }
        }
        else //Mostramos formulario
        {
            $listaProvincias = $this->modeloProvincias->ListarProvincias();

            return CargarVista(BASE_DIR.'/views/cuerpo.php',
                array(
                    'accion' => 'buscar',
                    'tituloPagina' => 'Buscar envíos',
                    'listaProvincias' => $listaProvincias
                ));
        }
    }
}