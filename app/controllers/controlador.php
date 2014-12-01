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
     * Funcion de prueba de vistas
     */
    public function prueba()
    {
        $titulo = CargarVista(BASE_DIR.'/views/titulo.php', 
            array(
                'tituloPagina' => 'Esto funciona'
                ));

        $mensaje = CargarVista(BASE_DIR.'/views/mensaje.php',
            array(
                'mensaje' => 'Esto es un mensaje de prueba'
                ));
        
        $debug = CargarVista(BASE_DIR.'/views/debug.php',
            array(
                'debug' => $this->modeloProvincias->ListarProvinciasIdxCodigo()
                ));

        return $titulo.$mensaje.$debug;
    }

    /**
     * Función inicio que se ejecuta por defecto
     * @return string
     */
    public function inicio(){
        //Ahora utilizamos cargar_vista_helper para generar el html del cuerpo
        $titulo = CargarVista(BASE_DIR.'/views/titulo.php',
            array(
                'tituloPagina' => 'Inicio'
            ));

        return $titulo;
    }

    /**
     * Functión que trata el evento de listar envíos
     * @return string
     */
    public function listar()
    {
        $titulo = CargarVista(BASE_DIR . '/views/titulo.php',
                array(
                    'tituloPagina' => 'Listar envíos'
                    ));


        ############ PAGINACIÓN ############

        if(isset($_GET['pagina']))
        {
            $paginaActual = $_GET['pagina'];
        }
        else
        {
            $paginaActual = 1;
        }

        $total = $this->modeloEnvios->NumEnvios();
        $resultadosPorPagina = 3;
        $numeroPaginas = ceil($total/$resultadosPorPagina);
        $inicio = ($paginaActual-1) * $resultadosPorPagina;

        if($total>0 && $paginaActual>0 && $paginaActual<=$numeroPaginas)
        {
            //Cargamos el paginador con los datos adecuados
             $paginador = CargarVista(BASE_DIR . '/views/paginador.php',
                array(
                    'href' => '?ctrl=controlador&accion=listar&pagina=',
                    'paginaActual' => $paginaActual,
                    'numeroPaginas' => $numeroPaginas
                ));
            $resto = $total%$resultadosPorPagina;

            if($resto!==0 && $paginaActual === $numeroPaginas) //Si estamos en la última página y no hay exactamente $resultadosPorPagina resultados
            {
                $listaEnvios = $this->modeloEnvios->ListarEnvios($inicio, $resto); //Hasta el último debería ser
            }
            else
            {
                $listaEnvios = $this->modeloEnvios->ListarEnvios($inicio, $resultadosPorPagina);
            }
            ####################################

            $listaProvincias = $this->modeloProvincias->ListarProvinciasIdxCodigo();
            foreach ($listaEnvios as $id => $envio)
            {
                $listaEnvios[$id]['provincia'] = $listaProvincias[$listaEnvios[$id]['provincia']];


                if($envio)
                {

                    switch(strtoupper($envio['estado']))
                    {
                        case 'P':
                            $listaEnvios[$id]['estado'] = 'Pendiente';
                            $listaEnvios[$id]['estadoLabel']  = 'label-primary';
                            break;
                        case 'E':
                            $listaEnvios[$id]['estado'] = 'Entregado';
                            $listaEnvios[$id]['estadoLabel']  = 'label-success';
                            break;
                        case 'D':
                            $listaEnvios[$id]['estado'] = 'Devuelto';
                            $listaEnvios[$id]['estadoLabel'] = 'label-danger';
                            break;
                    }
                }


                //Damos la vuelta a las fechas y cambiamos '-' por '/'
                $listaEnvios[$id]['fecha_crea'] = join('/', array_reverse(explode('-',$listaEnvios[$id]['fecha_crea'])));
                $listaEnvios[$id]['fecha_ent'] = ($listaEnvios[$id]['fecha_ent']!==NULL)?join('/', array_reverse(explode('-',$listaEnvios[$id]['fecha_ent']))) : 'sin especificar';

            }

            $listar = CargarVista(BASE_DIR . '/views/listar.php',
                array(
                    'listaEnvios' => $listaEnvios
                    ));

            return $titulo.$paginador.$listar;

       
        }
        else
        {
            $mensaje = CargarVista(BASE_DIR . '/views/mensaje.php',
                array(
                    'mensaje' => 'No hay envíos registrados.'
                    ));

            return $titulo.$mensaje;
        }
        //*/
    }

    /**
     * Función que trata el evento de crear envío
     * @return string
     */
    public function crear()
    {
        $titulo = CargarVista(BASE_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Crear nuevo envío'
            ));

        if($_POST)
        {
            /**
             * FILTRADO --> TODO: Falta filtrar la informaciónen crear. En principio suponemos que no hay problemas
             */

            //Añadimos la fecha de creación: Se debe crear automáticamente sin que el usuario la introduzca
            $_POST['fecha_crea'] = date('Y-m-d');
            $consulta = $this->modeloEnvios->CrearEnvio($_POST);
            $mensaje = CargarVista(BASE_DIR . '/views/mensaje.php',
                array(
                    'mensaje' => 'Envío creado correctamente'
                ));
        }
        else {
            $provincias = $this->modeloProvincias->ListarProvinciasIdxCodigo();

            $formulario = CargarVista(BASE_DIR . '/views/formulario_crea_envio.php',
                array(
                    'accion' => '?ctrl=controlador&accion=crear',
                    'listaProvincias' => $provincias
                ));
        }

        return (isset($mensaje))? $titulo.$mensaje: $titulo.$formulario;
    }

    /**
     * Función que trata el evento de editar envío
     * @return string
     */
    public function editar()
    {
        $titulo = CargarVista(BASE_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Editar envío'
                ));

        if($_POST) //Venimos de algún formulario
        {
            /**
             * FILTRADO --> TODO: Falta filtrar la el cod_envio (Si no está vacío y si existe en la base de datos). En principio suponemos que no hay problemas
             */

            if(count($_POST)===1 && isset($_POST['cod_envio'])) //Si SÓLO hemos especificado el cod_envio y si existe dicho envío...
            {
                $datosEnvio = $this->modeloEnvios->BuscarEnvios(array('cod_envio' => $_POST['cod_envio']));

                if($datosEnvio) //Si existe el envío especificado
                {
                    $provincias = $this->modeloProvincias->ListarProvinciasIdxCodigo();

                    //Mostramos el formulario de edición de envío
                    $formulario = CargarVista(BASE_DIR . '/views/formulario_edita_envio.php',
                        array(
                            'accion' => '?ctrl=controlador&accion=editar',
                            'datosEnvio' => $datosEnvio[0],
                            'listaProvincias' => $provincias
                        ));
                    return $titulo.$formulario;
                }
                else
                {
                    $mensaje = CargarVista(BASE_DIR . '/views/mensaje.php',
                        array(
                            'mensaje' => 'El envío especificado no se encuentra en la base de datos.'
                        ));

                    return $titulo.$mensaje;
                }
            }
            else //Hemos especificado más datos -> venimos del formulario de edición
            {
                /**
                 * FILTRADO --> TODO: Falta filtrar la información en editar. En principio suponemos que no hay problemas
                 */

                $this->modeloEnvios->EditarEnvio($_POST['cod_envio'], $_POST);
                $mensaje = CargarVista(BASE_DIR . '/views/mensaje.php',
                    array(
                        'mensaje' => 'Envío modificado correctamente.'
                    ));

                return $titulo.$mensaje;
            }

        }
        else {  //Mostramos el formulario de elección de pedido

            $formulario = CargarVista(BASE_DIR . '/views/formulario_sel_envio.php',
                array(
                    'accion' => '?ctrl=controlador&accion=editar'

                ));

            return $titulo.$formulario;
        }

    }

    /**
     * Función que trata el evento de eliminar envío
     * @return string
     */
    public function eliminar()
    {
        $titulo = CargarVista(BASE_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Eliminar envío'
            ));

        if($_POST)
        {

            if(count($_POST)===1 && isset($_POST['cod_envio']))
            {
                /**
                 * FILTRADO --> TODO: Falta filtrar la el cod_envio (Si no está vacío y si existe en la base de datos). En principio suponemos que no hay problemas
                 */

                if($this->modeloEnvios->BuscarEnvios(array('cod_envio' => $_POST['cod_envio']))) {

                    $this->modeloEnvios->EliminarEnvio($_POST['cod_envio']);
                    $mensaje = CargarVista(BASE_DIR . '/views/mensaje.php',
                        array(
                            'mensaje' => 'Envío eliminado correctamente.'
                        ));
                }
                else
                {
                    $mensaje = CargarVista(BASE_DIR . '/views/mensaje.php',
                        array(
                            'mensaje' => 'El envío especificado no se encuentra en la base de datos.'
                        ));
                }
                return $titulo.$mensaje;
            }
        }
        else
        {
            $formulario = CargarVista(BASE_DIR . '/views/formulario_sel_envio.php',
                array(
                    'accion' => '?ctrl=controlador&accion=eliminar'
                ));

            return $titulo.$formulario;
        }
    }

    /**
     * Función que trata el evento de anotar recepción de un envío
     * @return string
     */
    public function anotar_recepcion()
    {
        $titulo = CargarVista(BASE_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Eliminar envío'
            ));

        if($_POST)
        {
            if(count($_POST)===1 && isset($_POST['cod_envio']))
            {
                /**
                 * FILTRADO --> TODO: Falta filtrar la el cod_envio (Si no está vacío y si existe en la base de datos). En principio suponemos que no hay problemas
                 */

                if($this->modeloEnvios->BuscarEnvios(array('cod_envio' => $_POST['cod_envio']))) { //Si existe el envío especificado
                    //Cambiamos el estado del envío a Entregado y anotamos la fecha de entrega
                    $this->modeloEnvios->EditarEnvio($_POST['cod_envio'],
                        array('estado' => 'E',
                              'fecha_ent' => date('Y-m-d')
                        ));

                    $mensaje = CargarVista(BASE_DIR . '/views/mensaje.php',
                        array(
                            'mensaje' => 'Recepción anotada correctamente.'
                        ));
                }
                else
                {
                    $mensaje = CargarVista(BASE_DIR . '/views/mensaje.php',
                        array(
                            'mensaje' => 'El envío especificado no se encuentra en la base de datos.'
                        ));
                }
            }
            return $titulo.$mensaje;
        }
        else
        {
            $formulario = CargarVista(BASE_DIR . '/views/formulario_sel_envio.php',
                array(
                    'accion' => '?ctrl=controlador&accion=anotar_recepcion'
                ));
            return $titulo.$formulario;
        }
    }

    /**
     * Función que trata el evento de buscar envío
     * @return string
     */
    public function buscar()
    {
        $titulo = CargarVista(BASE_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Buscar envíos'
            ));

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
                $listaProvincias = $this->modeloProvincias->ListarProvinciasIdxCodigo();
                foreach ($listaEnvios as $id => $envio)
                {
                    $listaEnvios[$id]['provincia'] = $listaProvincias[$listaEnvios[$id]['provincia']];


                    if($envio)
                    {

                        switch(strtoupper($envio['estado']))
                        {
                            case 'P':
                                $listaEnvios[$id]['estado'] = 'Pendiente';
                                $listaEnvios[$id]['estadoLabel']  = 'label-primary';
                                break;
                            case 'E':
                                $listaEnvios[$id]['estado'] = 'Entregado';
                                $listaEnvios[$id]['estadoLabel']  = 'label-success';
                                break;
                            case 'D':
                                $listaEnvios[$id]['estado'] = 'Devuelto';
                                $listaEnvios[$id]['estadoLabel'] = 'label-danger';
                                break;
                        }
                    }


                    //Damos la vuelta a las fechas y cambiamos '-' por '/'
                    $listaEnvios[$id]['fecha_crea'] = join('/', array_reverse(explode('-',$listaEnvios[$id]['fecha_crea'])));
                    $listaEnvios[$id]['fecha_ent'] = ($listaEnvios[$id]['fecha_ent']!==NULL)?join('/', array_reverse(explode('-',$listaEnvios[$id]['fecha_ent']))) : 'sin especificar';

                }

                $listar = CargarVista(BASE_DIR . '/views/listar.php',
                    array(
                        'listaEnvios' => $listaEnvios
                    ));

                return $titulo.$listar;
            }
            else
            {
                $mensaje = CargarVista(BASE_DIR.'/views/mensaje.php',
                    array(
                        'mensaje' => 'No hay envíos que cumplan esas condiciones.'
                    ));
                return $titulo.$mensaje;
            }
        }
        else //Mostramos formulario
        {
            $listaProvincias = $this->modeloProvincias->ListarProvinciasIdxCodigo();

            $formulario = CargarVista(BASE_DIR.'/views/formulario_crea_envio.php',
                array(
                    'accion' => '?ctrl=controlador&accion=buscar',
                    'listaProvincias' => $listaProvincias
                ));
            return $titulo.$formulario;
        }
    }
}