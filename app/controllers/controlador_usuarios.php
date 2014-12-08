<?php
/**
 * CONTROLADOR DE USUARIOS
 */

include_once APP_DIR . '/models/modelo_usuarios.php';

class ControladorUsuarios
{
    private $modeloUsuarios;
    //TODO: Falta definir los roles con sus respectivas acciones permitidas

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
        $err = array();

        if(isset($datos['usuario']))
        {
            if(empty($datos['usuario']))
            {
                $err['usuario'] = 'Debe especificar un usuario.';
            }
            else
            {
                $patron = "/^[a-zA-Z_]{1,25}$/"; //No se aceptan espacios...tan sólo mayusculas y minúsculas y barra baja
                if(!preg_match($patron, $datos['usuario']))
                {
                    $err['usuario'] = 'El usuario no es correcto.';
                }
            }
        }
        if(isset($datos['password']))
        {
            if(empty($datos['password']))
            {
                $err['password'] = 'Debe especificar el password.';
            }
            else
            {
                $patron = "/^[A-Z0-9,.-_]{1,25}$/i";
                if(!preg_match($patron, $datos['password']))
                {
                    $err['password'] = 'El password no es correcto.';
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
                $mensaje = CargarVista(APP_DIR . '/views/mensaje_exito.php',
                    array(
                        'mensaje' => 'Bienvenido <strong>'.$_SESSION['usuario'].'</strong>, ahora puedes acceder a
                        las funcionalidades de la aplicación.'
                    ));
                return $titulo.$mensaje;
            }
            else
            {
                $formulario = CargarVista(APP_DIR . '/views/formulario_acceso.php',
                    array(
                        'accion' => '?opcion=acceder'
                    ));
                $mensaje = CargarVista(APP_DIR . '/views/mensaje_error.php',
                    array(
                        'mensaje' => 'Datos erróneos. Por favor, inténtelo otra vez.'
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
                   'mensaje' => 'No hay usuarios registrados.'
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
            //Encriptamos la contraseña del usuario
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $consulta = $this->modeloUsuarios->CrearUsuario($_POST);
            $mensaje = CargarVista(APP_DIR . '/views/mensaje_exito.php',
                array(
                    'mensaje' => 'Usuario creado correctamente'
                ));
            return $titulo.$mensaje;
        }
    }

    /**
     * Edición de usuario
     */
    public function EditarUsuario()
    {
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
                    $formulario = CargarVista(APP_DIR . '/views/formulario_sel_usuario.php',
                        array(
                            'accion' => '?opcion=editar_usuario',
                            'errores' => $errores
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
                               'mensaje' => 'El usuario especificado no está registrado.'
                            ));
                        return $titulo.$mensaje;
                    }
                }

            }
            else if(isset($_POST['password'])) //Venimos del formulario de cambio de contraseña
            {
                if($errores)
                {
                    $formulario = CargarVista(APP_DIR . '/views/formulario_edita_usuario.php',
                        array(
                            'accion' => '?opcion=editar_usuario',
                            'errores' => $errores
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
                           'mensaje' => 'Password actualizado con éxito.'
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
        $titulo = CargarVista(APP_DIR . '/views/titulo.php',
            array(
                'tituloPagina' => 'Eliminar envío'
            ));

        if($_POST)
        {
            $errores = $this->Filtro($_POST);

            if(count($_POST)===1 && isset($_POST['usuario']))
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
                            $this->modeloUsuarios->EliminarUsuario($_POST['usuario']);
                            $mensaje = CargarVista(APP_DIR . '/views/mensaje_exito.php',
                                array(
                                    'mensaje' => 'Usuario eliminado correctamente.'
                                ));
                        }
                        else
                        {
                            $mensaje = CargarVista(APP_DIR . '/views/mensaje_error.php',
                                array(
                                    'mensaje' => 'No se puede eliminar el usuario que está en la sesión.'
                                ));
                        }
                    }
                    else
                    {
                        $mensaje = CargarVista(APP_DIR . '/views/mensaje.php',
                            array(
                                'mensaje' => 'El usuario especificado no se encuentra en la base de datos.'
                            ));
                    }
                    return $titulo . $mensaje;
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