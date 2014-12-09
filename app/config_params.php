<?php
/**
 * CONFIGURACIÓN DE PARÁMETROS DE LA APLICACIÓN
 */

/**
 * Tiempo de duración de la sesión
 */
$tiempoSesion = '1800';

/**
 * Resultados por página
 */
$paginacion = '3';

/**
 * Mensajes de la aplicación
 */
$msjFiltroEnvios = array(
    'cod_envio_no_especificado' => 'Debe introducir un código de envío.',
    'cod_envio_no_valido' => 'El código de envío no es correcto.',
    'destinatario_no_especificado' => 'Debe especificar un destinatario.',
    'destinatario_no_valido' => 'El destinatario no puede contener números o signos de puntuación.',
    'telefono_no_especificado' => 'Debe especificar un teléfono de contacto.',
    'telefono_no_valido' => 'El teléfono no es válido.',
    'direccion_no_valida' => 'La dirección no es válida.',
    'poblacion_no_valida' => 'La población no es válida.',
    'cod_postal_no_valido' => 'El código postal no es válido.',
    'provincia_no_especificada' => 'Debe seleccionar una provincia.',
    'provincia_no_valida' => 'La provincia no es correcta.',
    'email_no_especificado' => 'Debe especificar una dirección de correo electrónico.',
    'email_no_valido' => 'El email no es válido.',
);

$msjControladorEnvios = array(
    'listar_no_envios' => 'No hay envíos registrados',
    'crear_envio_ok' => 'Envío creado correctamente.',
    'envio_no_encontrado' => 'El envío especificado no se encuentra en la base de datos.',
    'editar_envio_ok' => 'Envío modificado correctamente.',
    'eliminar_envio_ok' => 'Envío eliminado correctamente.',
    'anotar_recepcion_ok' => 'Recepción anotada correctamente.',
    'buscar_no_envios' => 'No hay envíos que cumplan esas condiciones.'
);

$msjFiltroUsuarios = array(
    'usuario_no_especificado' => 'Debe especificar un usuario.',
    'usuario_no_valido' => 'El usuario no es correcto',
    'password_no_especificado' => 'Debe especificar un password',
    'password_no_valido' => 'El password no es correcto'
);

$msjControladorUsuarios = array(
    'login_error' => 'Datos erróneos. Por favor, inténtelo otra vez.',
    'listar_no_usuarios' => 'No hay usuarios registrados.',
    'crear_usuario_ok' => 'Usuario creado correctamente.',
    'crear_usuario_repetido' => 'El usuario ya se encuentra registrado',
    'usuario_no_encontrado' => 'El usuario especificado no está registrado.',
    'editar_usuario_ok' => 'Password actualizado con éxito.',
    'eliminar_usuario_ok' => 'Usuario eliminado correctamente',
    'eliminar_usuario_error' => 'No se puede eliminar el usuario que está en la sesión.'
);




