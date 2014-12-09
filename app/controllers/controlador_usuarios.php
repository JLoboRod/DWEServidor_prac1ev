<?php
/**
 * CONTROLADOR DE USUARIOS
 */

include_once APP_DIR . '/models/modelo_usuarios.php';

class ControladorUsuarios
{
    private $modeloUsuarios;

    //TODO: Mejora futura: definir los roles con sus respectivas acciones permitidas

    function __construct()
    {
        $this->modeloUsuarios = new ModeloUsuarios();
    }

    /**
     * Filtra los datos $datos y devuelve un array con los
     * mensajes de error para cada campo
     * @param $datos
     * @return array
     */
    private function Filtro($datos=array())
    {
        $msj = GetConfigValue('msjFiltroUsuarios');
        $err = array();

        if(isset($datos['usuario']))
        {
            if(empty($datos['usuario']))
            {
                $err['usuario'] = $msj['usuario_no_especificado'];
            }
            else
            {
                $patron = "/^[a-zA-Z_]{1,25}$/"; //No se aceptan espacios...tan sólo mayusculas y minúsculas y barra baja
                if(!preg_match($patron, $datos['usuario']))
                {
                    $err['usuario'] = $msj['usuario_no_valido'];
                }
            }
        }
        if(isset($datos['password']))
        {
            if(empty($datos['password']))
            {
                $err['password'] = $msj['password_no_especificado'];
            }
            else
            {
                $patron = "/^[A-Z0-9,.-_]{1,25}$/i";
                if(!preg_match($patron, $datos['password']))
                {
                    $err['password'] = $msj['password_no_valido'];
                }
            }
        }

        return $err;
    }

    /**
     * Acceso a la aplicación
     */
    public function Acceder()
    {
        $msj = GetConfigValue('msjControladorUsuarios');
        $titulo = CargarVista(APP_DIR.'/views/titulo.php',
            array(
                'tituloPagina' => 'Acceder'
            ));

        if($_POST)
        {
            $datosUsuario = $this->modeloUsuarios->BuscarUsuario($_POST['usuario']);

            if(isset($datosUsuario) && $datosUsuario['usuario'] == $_POST['usuario']
                && password_verify($_POST['password'], $datosUsuario['password']))
            {
                $_SESSION['usuario'] = $datosUsuario['usuario']; //Establecemos nombre a la sesión
                $_SESSION['hora'] = time();

                header('Location: index.php');
            }
            else
            {
                $formulario = CargarVista(APP_DIR . '/views/formulario_acceso.php',
                    array(
                        'accion' => '?opcion=acceder'
                    ));
                $mensaje = CargarVista(APP_DIR . '/views/mensaje_error.php',
                    array(
                        'mensaje' => $msj['login_error']
                    ));
                return $titulo.$formulario.$mensaje;
            }
        }
        else
        {
            $formulario = CargarVista(APP_DIR . '/views/formulario_acceso.php',
                array(
                    'accion' => '?opcion=acceder'
                ));
                return $titulo.$formulario;
        }

    }

    /**
     * Cerrar sesión
     */
    public function Salir()
    {
        unset($_SESSION);
        session_destroy();

        header('Location: index.php');
    }

    /**
     * Listar usuarios registrados
     * @return string
     */
    public function ListarUsuarios()
    {
        $msj = GetConfigValue('msjControladorUsuarios');
        $titulo = CargarVista(APP_DIR.'/views/titulo.php',
            array(
                'tituloPagina' => 'Usuarios registrados'
            ));

        $listaUsuarios = $this->modeloUsuarios->ListarUsuarios();

        if($listaUsuarios)
        {
            $listarUsuarios = CargarVista(APP_DIR.'/views/listar_usuarios.php',
                array(
                    'listaUsuarios' => $listaUsuarios
                ));

            return $titulo.$listarUsuarios;
        }
        else
        {
            $mensaje = CargarVista(APP_DIR . '/views/mensaje.php',
                array(
                   'mensaje' => $msj['listar_no_usuarios']
                ));
            return $titulo.$mensaje;
        }
    }

    /**
     * Creación de un nuevo usuario
     * @return string
     */
    public function CrearUsuario()
    {
        $msj = GetConfigValue('msjControladorUsuarios');
        $titulo = CargarVista(APP_DIR.'/views/titulo.php',
            array(
                'tituloPagina' => 'Crear usuario'
            ));

        if($_POST)
        {
            $errores = $this->Filtro($_POST);
        }
        if((isset($errores) && !empty($errores)) || !$_POST)
        {
            if(isset($errores))
            {
                $claseCampoForm = [];

                foreach($errores as $campo => $error)
                {
                    $claseCampoForm[$campo] = ($error === '')? '':'has-error';
                }

                $formulario = CargarVista(APP_DIR . '/views/formulario_crea_usuario.php',
                    array(
                        'accion' => '?opcion=crear_usuario',
                        'errores' => $errores,
                        'claseCampoForm' => $claseCampoForm
                    ));
            }
            else
            {
                $formulario = CargarVista(APP_DIR . '/views/formulario_crea_usuario.php',
                    array(
                        'accion' => '?opcion=crear_usuario'
                    ));
            }
            return $titulo . $formulario;
        }
        else
        {
            if($this->modeloUsuarios->BuscarUsuario($_POST['usuario']))
            {
                $mensaje = CargarVista(APP_DIR . '/views/mensaje_error.php',
                    array(
                        'mensaje' => $msj['crear_usuario_repetido']
                    ));
                return $titulo . $mensaje;
            }
            else {


                //Encriptamos la contraseña del usuario
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $consulta = $this->modeloUsuarios->CrearUsuario($_POST);
                $mensaje = CargarVista(APP_DIR . '/views/mensaje_exito.php',
                    array(
                        'mensaje' => $msj['crear_usuario_ok']
                    ));
                return $titulo . $mensaje;
            }
        }
    }

    /**
     * Edición de usuario
     */
    public function EditarUsuario()
    {
        $msj = GetConfigValue('msjControladorUsuarios');
        $titulo = CargarVista(APP_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Editar usuario'
            ));

        if($_POST)
        {
            $errores = $this->Filtro($_POST);

            if(isset($_POST['usuario'])) { //Venimos del formulario de selección de usuario
                $datosUsuario = $this->modeloUsuarios->BuscarUsuario($_POST['usuario']);

                if($errores)
                {
                    $claseCampoForm = [];

                    foreach($errores as $campo => $error)
                    {
                        $claseCampoForm[$campo] = ($error === '')? '':'has-error';
                    }

                    $formulario = CargarVista(APP_DIR . '/views/formulario_sel_usuario.php',
                        array(
                            'accion' => '?opcion=editar_usuario',
                            'errores' => $errores,
                            'claseCampoForm' => $claseCampoForm
                        ));
                    return $titulo . $formulario;
                }
                else {
                    if ($datosUsuario) //El usuario existe
                    {
                        $_SESSION['editar_usuario']=$datosUsuario['usuario']; //almacenamos en la sesión en usuario a editar
                        $formulario = CargarVista(APP_DIR . '/views/formulario_edita_usuario.php',
                            array(
                                'accion' => '?opcion=editar_usuario'
                            ));
                        return $titulo . $formulario;
                    }
                    else
                    {
                        $mensaje = CargarVista(APP_DIR.'/views/mensaje.php',
                            array(
                               'mensaje' => $msj['usuario_no_encontrado']
                            ));
                        return $titulo.$mensaje;
                    }
                }

            }
            else if(isset($_POST['password'])) //Venimos del formulario de cambio de contraseña
            {
                if($errores)
                {
                    $claseCampoForm = [];

                    foreach($errores as $campo => $error)
                    {
                        $claseCampoForm[$campo] = ($error === '')? '':'has-error';
                    }

                    $formulario = CargarVista(APP_DIR . '/views/formulario_edita_usuario.php',
                        array(
                            'accion' => '?opcion=editar_usuario',
                            'errores' => $errores,
                            'claseCampoForm' => $claseCampoForm
                        ));
                    return $titulo.$formulario;
                }
                else
                {
                    //Encriptamos la contraseña del usuario
                    $this->modeloUsuarios->EditarUsuario($_SESSION['editar_usuario'],
                        array(
                            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
                        ));

                    $mensaje = CargarVista(APP_DIR.'/views/mensaje_exito.php',
                        array(
                           'mensaje' => $msj['editar_usuario_ok']
                        ));
                    unset($_SESSION['editar_usuario']); //Eliminamos el usuario editado

                    return $titulo.$mensaje;
                }
            }

        }
        else //Mostramos el formulario de elección de pedido
        {

            $formulario = CargarVista(APP_DIR . '/views/formulario_sel_usuario.php',
                array(
                    'accion' => '?opcion=editar_usuario'
                ));

            return $titulo.$formulario;
        }
    }

    /**
     * Eliminar usuario
     */
    function EliminarUsuario()
    {
        $msj = GetConfigValue('msjControladorUsuarios');
        $titulo = CargarVista(APP_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Eliminar envío'
            ));

        if($_POST)
        {
            $errores = $this->Filtro($_POST);

            if(isset($_POST['usuario']))
            {
                if($errores)
                {
                    $claseCampoForm = [];

                    foreach($errores as $campo => $error)
                    {
                        $claseCampoForm[$campo] = ($error === '')? '':'has-error';
                    }

                    $formulario = CargarVista(APP_DIR . '/views/formulario_sel_usuario.php',
                        array(
                            'accion' => '?opcion=eliminar_usuario',
                            'errores' => $errores,
                            'claseCampoForm' => $claseCampoForm
                        ));

                    return $titulo.$formulario;
                }
                else {
                    $usuario = $this->modeloUsuarios->BuscarUsuario($_POST['usuario']);
                    if ($usuario)
                    {
                        if($usuario['usuario']!==$_SESSION['usuario'])
                        {
                            //Confirmación de eliminación
                            $formulario = CargarVista(APP_DIR .'/views/confirmar_eliminar.php',
                                array(
                                    'accion' => '?opcion=eliminar_usuario',
                                    'dato' => $_POST['usuario']
                                ));
                            return $titulo.$formulario;
                        }
                        else
                        {
                            $mensaje = CargarVista(APP_DIR . '/views/mensaje_error.php',
                                array(
                                    'mensaje' => $msj['eliminar_usuario_error']
                                ));
                        }
                    }
                    else
                    {
                        $mensaje = CargarVista(APP_DIR . '/views/mensaje.php',
                            array(
                                'mensaje' => $msj['usuario_no_encontrado']
                            ));
                    }
                    return $titulo . $mensaje;
                }
            }
            else if(isset($_POST['oculto'])) //Venimos de la confirmación de eliminación
            {
                if(isset($_POST['si']))
                {
                    $this->modeloUsuarios->EliminarUsuario($_POST['oculto']);
                    $mensaje = CargarVista(APP_DIR . '/views/mensaje_exito.php',
                        array(
                            'mensaje' => $msj['eliminar_usuario_ok']
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
            $formulario = CargarVista(APP_DIR . '/views/formulario_sel_usuario.php',
                array(
                    'accion' => '?opcion=eliminar_usuario'
                ));

            return $titulo.$formulario;
        }
    }
}