<?php
/**
 * CONTROLADOR DE ENVÍOS
 */

include_once APP_DIR . '/models/modelo_envios.php';
include_once APP_DIR . '/models/modelo_provincias.php';

class ControladorEnvios{

    private $modeloEnvios;
    private $modeloProvincias;
    private $msjEnvios;

    function __construct(){
        $this->modeloEnvios = new ModeloEnvios();
        $this->modeloProvincias = new ModeloProvincias();
    }

    /**
     * Filtra los datos $datos y devuelve un array con los
     * mensajes de error para cada campo
     * @param $datos
     * @return array
     */
    private function Filtro($datos=array())
    {
        $msj = $GLOBALS['msjFiltroEnvios'];
        $err = array();

        if(isset($datos['cod_envio']))
        {
            if($datos['cod_envio']==='')
            {
                $err['cod_envio'] = $msj['cod_envio_no_especificado'];
            }
            else
            {
                if(!filter_var($datos['cod_envio'], FILTER_VALIDATE_INT,
                    array( 'options' => array('min_range' => 1, 'max_range' => 99999999999))))
                {
                    $err['cod_envio'] = $msj['cod_envio_no_valido'];
                }
            }
        }
        if(isset($datos['destinatario']))
        {
            if(empty($datos['destinatario']))
            {
                $err['destinatario'] = $msj['destinatario_no_especificado'];
            }
            else
            {
                $patron = "/^[a-zA-ZaáéíóúäëïöüÁÉÍÓÚÄËÏÖÜñÑ ]+/";
                if(!preg_match($patron, $datos['destinatario']))
                {
                    $err['destinatario'] = $msj['destinatario_no_valido'];
                }
            }
        }
        if(isset($datos['telefono']))
        {
            if($datos['telefono']==='')
            {
                $err['telefono'] = $msj['telefono_no_especificado'];
            }
            else
            {
                $patron = "/(?!:\A|\s)(?!(\d{1,6}\s+\D)|((\d{1,2}\s+){2,2}))(((\+\d{1,3})
                |(\(\+\d{1,3}\)))\s*)?((\d{1,6})|(\(\d{1,6}\)))\/?(([ -.]?)\d{1,5}){1,5}((\s*
                (#|x|(ext))\.?\s*)\d{1,5})?(?!:(\Z|\w|\b\s))/";

                if(!preg_match($patron, $datos['telefono']))
                {
                    $err['telefono'] = $msj['telefono_no_valido'];
                }
            }
        }
        if(isset($datos['direccion'])) {
            $patron = "/^[a-zA-Z 0-9 üÜáéíóúÁÉÍÓÚñÑ,.-ºª\"]{1,45}$/";

            if (!$datos['direccion']==='') {
                if (!preg_match($patron, $datos['direccion'])) {
                    $err['direccion'] = $msj['direccion_no_valida'];
                }
            }
        }
        if(isset($datos['poblacion']))
        {
            if(!$datos['poblacion']==='')
            {
                if(!preg_match("/^[a-zA-Z ]{1,25}$/", $datos['poblacion']))
                {
                    $err['poblacion'] = $msj['poblacion_no_valida'];
                }
            }
        }
        if(isset($datos['cod_postal']))
        {
            if($datos['cod_postal']!=='')
            {
                $patron = "/^0[1-9][0-9]{3}|[1-4][0-9]{4}|5[0-2][0-9]{3}$/";
                if(!preg_match($patron, $datos['cod_postal']))
                {
                    $err['cod_postal'] = $msj['cod_postal_no_valido'];
                }
            }
        }
        if(isset($datos['provincia']))
        {
            if($datos['provincia']==='00')
            {
                $err['provincia'] = $msj['provincia_no_especificada'];
            }
            else
            {
                $patron = "/^0[1-9]|[1-4][0-9]|5[0-2]$/";
                if(!preg_match($patron, $datos['provincia']))
                {
                    $err['provincia'] = $msj['provincia_no_valida'];
                }
            }
        }
        if(isset($datos['email']))
        {
            if($datos['email']==='')
            {
                $err['email'] = $msj['email_no_especificado'];
            }
            else
            {
                if(!filter_var($datos['email'], FILTER_VALIDATE_EMAIL))
                {
                    $err['email'] = $msj['email_no_valido'];
                }
            }
        }
        return $err;
    }

    /**
     * Función inicio que se ejecuta por defecto
     * @return string
     */
    public function Inicio(){
        //Ahora utilizamos cargar_vista_helper para generar el html del cuerpo
        $titulo = CargarVista(APP_DIR.'/views/titulo.php',
            array(
                'tituloPagina' => 'Inicio'
            ));

        return $titulo;
    }

    /**
     * Functión que trata el evento de listar envíos
     * @return string
     */
    public function ListarEnvios()
    {
        $msj = $GLOBALS['msjControladorEnvios'];
        $titulo = CargarVista(APP_DIR . '/views/titulo.php',
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
        $resultadosPorPagina = $GLOBALS['paginacion'];
        $numeroPaginas = ceil($total/$resultadosPorPagina);
        $inicio = ($paginaActual-1) * $resultadosPorPagina;

        if($total>0 && $paginaActual>0 && $paginaActual<=$numeroPaginas)
        {
            //Cargamos el paginador con los datos adecuados
             $paginador = CargarVista(APP_DIR . '/views/paginador.php',
                array(
                    'href' => '?opcion=listar&pagina=',
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

            $listar = CargarVista(APP_DIR . '/views/listar.php',
                array(
                    'listaEnvios' => $listaEnvios
                    ));

            return $titulo.$paginador.$listar;

       
        }
        else
        {
            $mensaje = CargarVista(APP_DIR . '/views/mensaje.php',
                array(
                    'mensaje' => $msj['listar_no_envios']
                    ));

            return $titulo.$mensaje;
        }
        //*/
    }

    /**
     * Función que trata el evento de crear envío
     * @return string
     */
    public function CrearEnvio()
    {
        $msj = $GLOBALS['msjControladorEnvios'];
        $titulo = CargarVista(APP_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Crear nuevo envío'
            ));

        if($_POST)
        {
            $errores = $this->Filtro($_POST);

        }
        if((isset($errores) && !empty($errores)) || !$_POST)
        {
            $provincias = $this->modeloProvincias->ListarProvinciasIdxCodigo();

            if(isset($errores))
            {
                $claseCampoForm = [];

                foreach($errores as $campo => $error)
                {
                    $claseCampoForm[$campo] = ($error === '')? '':'has-error';
                }

                $formulario = CargarVista(APP_DIR . '/views/formulario_crea_envio.php',
                    array(
                        'accion' => '?opcion=crear',
                        'listaProvincias' => $provincias,
                        'errores' => $errores,
                        'claseCampoForm' => $claseCampoForm
                    ));
            }
            else
            {
                $formulario = CargarVista(APP_DIR . '/views/formulario_crea_envio.php',
                    array(
                        'accion' => '?opcion=crear',
                        'listaProvincias' => $provincias
                    ));
            }
            return $titulo . $formulario;
        }
        else
        {
            //Añadimos la fecha de creación: Se debe crear automáticamente sin que el usuario la introduzca
            $_POST['fecha_crea'] = date('Y-m-d');
            $consulta = $this->modeloEnvios->CrearEnvio($_POST);
            $mensaje = CargarVista(APP_DIR . '/views/mensaje_exito.php',
                array(
                    'mensaje' => $msj['crear_envio_ok']
                ));
            return $titulo.$mensaje;
        }
    }

    /**
     * Función que trata el evento de editar envío
     * @return string
     */
    public function EditarEnvio()
    {
        $msj = $GLOBALS['msjControladorEnvios'];
        $titulo = CargarVista(APP_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Editar envío'
                ));

        if($_POST) //Venimos de algún formulario
        {
            $provincias = $this->modeloProvincias->ListarProvinciasIdxCodigo();

            //Filtrado
            $errores = $this->Filtro($_POST);

            if(count($_POST)===1 && isset($_POST['cod_envio'])) //Si SÓLO hemos especificado el cod_envio y si existe dicho envío...
            {
                $datosEnvio = $this->modeloEnvios->BuscarEnvios(array('cod_envio' => $_POST['cod_envio']));

                if($errores)
                {
                    $claseCampoForm = [];

                    foreach($errores as $campo => $error)
                    {
                        $claseCampoForm[$campo] = ($error === '')? '':'has-error';
                    }

                    $formulario = CargarVista(APP_DIR . '/views/formulario_sel_envio.php',
                        array(
                            'accion' => '?opcion=editar',
                            'errores' => $errores,
                            'claseCampoForm' => $claseCampoForm
                        ));

                    return $titulo.$formulario;
                }
                else
                {
                    if ($datosEnvio) //Si existe el envío especificado
                    {
                        //Mostramos el formulario de edición de envío
                        $formulario = CargarVista(APP_DIR . '/views/formulario_edita_envio.php',
                            array(
                                'accion' => '?opcion=editar',
                                'datosEnvio' => $datosEnvio[0],
                                'listaProvincias' => $provincias
                            ));
                        return $titulo . $formulario;
                    }
                    else
                    {
                        $mensaje = CargarVista(APP_DIR . '/views/mensaje.php',
                            array(
                                'mensaje' => $msj['envio_no_encontrado']
                            ));

                        return $titulo . $mensaje;
                    }
                }
            }
            else //Hemos especificado más datos -> venimos del formulario de edición
            {
                if($errores)
                {
                    $claseCampoForm = [];

                    foreach($errores as $campo => $error)
                    {
                        $claseCampoForm[$campo] = ($error === '')? '':'has-error';
                    }

                    $formulario = CargarVista(APP_DIR . '/views/formulario_crea_envio.php',
                        array(
                            'accion' => '?opcion=editar',
                            'listaProvincias' => $provincias,
                            'errores' => $errores,
                            'claseCampoForm' => $claseCampoForm
                        ));
                    return $titulo.$formulario;
                }
                else
                {
                    $this->modeloEnvios->EditarEnvio($_POST['cod_envio'], $_POST);
                    $mensaje = CargarVista(APP_DIR . '/views/mensaje_exito.php',
                        array(
                            'mensaje' => $msj['editar_envio_ok']
                        ));

                    return $titulo . $mensaje;
                }
            }

        }
        else //Mostramos el formulario de elección de pedido
        {

            $formulario = CargarVista(APP_DIR . '/views/formulario_sel_envio.php',
                array(
                    'accion' => '?opcion=editar'
                ));

            return $titulo.$formulario;
        }

    }

    /**
     * Función que trata el evento de eliminar envío
     * @return string
     */
    public function EliminarEnvio()
    {
        $msj = $GLOBALS['msjControladorEnvios'];
        $titulo = CargarVista(APP_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Eliminar envío'
            ));

        if($_POST)
        {
            $errores = $this->Filtro($_POST);

            if(isset($_POST['cod_envio']))
            {
                if($errores)
                {
                    $claseCampoForm = [];

                    foreach($errores as $campo => $error)
                    {
                        $claseCampoForm[$campo] = ($error === '')? '':'has-error';
                    }

                    $formulario = CargarVista(APP_DIR . '/views/formulario_sel_envio.php',
                        array(
                            'accion' => '?opcion=eliminar',
                            'errores' => $errores,
                            'claseCampoForm' => $claseCampoForm
                        ));

                    return $titulo.$formulario;
                }
                else {
                    if ($this->modeloEnvios->BuscarEnvios(array('cod_envio' => $_POST['cod_envio']))) {

                        //Confirmación de eliminación
                        $formulario = CargarVista(APP_DIR .'/views/confirmar_eliminar.php',
                            array(
                                'accion' => '?opcion=eliminar',
                                'dato' => $_POST['cod_envio']
                            ));
                        return $titulo.$formulario;

                    } else {
                        $mensaje = CargarVista(APP_DIR . '/views/mensaje.php',
                            array(
                                'mensaje' => $msj['envio_no_encontrado']
                            ));
                    }
                    return $titulo . $mensaje;
                }
            }
            else if(isset($_POST['oculto'])) //Venimos de la confirmación de eliminación
            {
                if(isset($_POST['si']))
                {
                    $this->modeloEnvios->EliminarEnvio($_POST['oculto']);
                    $mensaje = CargarVista(APP_DIR . '/views/mensaje_exito.php',
                        array(
                            'mensaje' => $msj['eliminar_envio_ok']
                        ));
                    return $titulo.$mensaje;
                }
                else if(isset($_POST['no']))
                {
                    header('Location: index.php');
                }
            }
        }
        else
        {
            $formulario = CargarVista(APP_DIR . '/views/formulario_sel_envio.php',
                array(
                    'accion' => '?opcion=eliminar'
                ));

            return $titulo.$formulario;
        }
    }

    /**
     * Función que trata el evento de anotar recepción de un envío
     * @return string
     */
    public function AnotarRecepcion()
    {
        $msj = $GLOBALS['msjControladorEnvios'];
        $titulo = CargarVista(APP_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Eliminar envío'
            ));

        if($_POST)
        {
            $errores = $this->Filtro($_POST);

            if(count($_POST)===1 && isset($_POST['cod_envio'])) {

                if ($errores) {
                    $claseCampoForm = [];

                    foreach ($errores as $campo => $error) {
                        $claseCampoForm[$campo] = ($error === '') ? '' : 'has-error';
                    }

                    $formulario = CargarVista(APP_DIR . '/views/formulario_sel_envio.php',
                        array(
                            'accion' => '?opcion=editar',
                            'errores' => $errores,
                            'claseCampoForm' => $claseCampoForm
                        ));

                    return $titulo . $formulario;
                } else {

                    if ($this->modeloEnvios->BuscarEnvios(array('cod_envio' => $_POST['cod_envio']))) { //Si existe el envío especificado
                        //Cambiamos el estado del envío a Entregado y anotamos la fecha de entrega
                        $this->modeloEnvios->EditarEnvio($_POST['cod_envio'],
                            array('estado' => 'E',
                                'fecha_ent' => date('Y-m-d')
                            ));

                        $mensaje = CargarVista(APP_DIR . '/views/mensaje_exito.php',
                            array(
                                'mensaje' => $msj['anotar_recepcion_ok']
                            ));
                    } else {
                        $mensaje = CargarVista(APP_DIR . '/views/mensaje.php',
                            array(
                                'mensaje' => $msj['envio_no_encontrado']
                            ));
                    }
                }
                return $titulo . $mensaje;
            }
        }
        else
        {
            $formulario = CargarVista(APP_DIR . '/views/formulario_sel_envio.php',
                array(
                    'accion' => '?opcion=anotar_recepcion'
                ));
            return $titulo.$formulario;
        }
    }

    /**
     * Función que trata el evento de buscar envío
     * @return string
     */
    public function BuscarEnvios()
    {
        $msj = $GLOBALS['msjControladorEnvios'];
        $titulo = CargarVista(APP_DIR . '/views/titulo.php',
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
                    if ($valor != '00') //Con esto prevenimos que el valor 00 entre como criterio de búsqueda
                    {
                        $datos[$clave] = $valor;
                    }
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

                $listar = CargarVista(APP_DIR . '/views/listar.php',
                    array(
                        'listaEnvios' => $listaEnvios
                    ));

                return $titulo.$listar;
            }
            else
            {
                $mensaje = CargarVista(APP_DIR.'/views/mensaje.php',
                    array(
                        'mensaje' => $msj['buscar_no_envios']
                    ));
                return $titulo.$mensaje;
            }
        }
        else //Mostramos formulario
        {
            $listaProvincias = $this->modeloProvincias->ListarProvinciasIdxCodigo();

            $formulario = CargarVista(APP_DIR.'/views/formulario_crea_envio.php',
                array(
                    'accion' => '?opcion=buscar',
                    'listaProvincias' => $listaProvincias
                ));
            return $titulo.$formulario;
        }
    }
}