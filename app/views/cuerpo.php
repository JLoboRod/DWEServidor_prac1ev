<?php

define("SALTO_LINEA", "\n");
define("TAB", "\t");

/**
 * Genera un formulario sin datos
 */
function GeneraHTMLFormVacio($accion, $listaProvincias)
{

    $html  = '<form role="form" action="?ctrl=controlador&accion='.$accion.'" method="post">'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="destinatario">Destinatario</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="destinatario" id="destinatario" value="'.ValorPost('destinatario').'" placeholder="Introduzca el destinatario">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="telefono">Teléfono</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="telefono" id="telefono" value="'.ValorPost('telefono').'" placeholder="Introduzca el teléfono de contacto">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="direccion">Dirección</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="direccion" id="direccion" value="'.ValorPost('direccion').'" placeholder="Introduzca la dirección de contacto">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="poblacion">Población</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="poblacion" id="poblacion" value="'.ValorPost('poblacion').'" placeholder="Introduzca el población">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="cod_postal">Código Postal</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="cod_postal" id="cod_postal" value="'.ValorPost('cod_postal').'" placeholder="Introduzca el teléfono de contacto">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="provincia">Provincia</label>'.SALTO_LINEA;
    $html .=  CreaSelect('provincia', $listaProvincias, ValorPost('provincia'));
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="email">Email</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="email" id="email" value="'.ValorPost('email').'" placeholder="Introduzca dirección de correo electrónico">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    /*
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="fecha_ent">Fecha de entrega</label>'.SALTO_LINEA;
    $html .= '<input type="date" class="form-control" name="fecha_ent" id="fecha_ent" value="'.ValorPost('fecha_ent').'" placeholder="Introduzca la fecha de entrega dd/mm/aaaa">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    */
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="observaciones">Observaciones</label>'.SALTO_LINEA;
    $html .= '<textarea class="form-control" name="observaciones" id="observaciones" value="'.ValorPost('observaciones').'" placeholder="¿Alguna observación?" rows="3"></textarea>'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;

    $html .= '<button type="submit" class="btn btn-default">Enviar</button>'.SALTO_LINEA;
    $html .= '</form>'.SALTO_LINEA;

    return $html;
}

/**
 * Genera un formulario de edición con los datos de un envío en concreto
 * @param $listaProvincias
 * @return string
 */
function GeneraHTMLFormEditar($datosEnvio, $listaProvincias)
{

    $html  = '<form role="form" action="?ctrl=controlador&accion=editar" method="post">'.SALTO_LINEA;

    /*
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="cod_envio">Código de envío</label>'.SALTO_LINEA;
    $html .= '<input type"text" class="form-control static" name="cod_envio" id="cod_envio" value="'.$datosEnvio["cod_envio"].'" disabled>'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    */

    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="cod_envio">Código de envío</label>'.SALTO_LINEA;
    $html .= '<input type"text" class="form-control static" name="cod_envio" id="cod_envio" value="'.$datosEnvio["cod_envio"].'" readonly>'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;


    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="destinatario">Destinatario</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="destinatario" id="destinatario" value="'.$datosEnvio["destinatario"].'" placeholder="Introduzca el destinatario">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="telefono">Teléfono</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="telefono" id="telefono" value="'.$datosEnvio["telefono"].'" placeholder="Introduzca el teléfono de contacto">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="direccion">Dirección</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="direccion" id="direccion" value="'.$datosEnvio["direccion"].'" placeholder="Introduzca la dirección de contacto">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="poblacion">Población</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="poblacion" id="poblacion" value="'.$datosEnvio["poblacion"].'" placeholder="Introduzca el población">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="cod_postal">Código Postal</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="cod_postal" id="cod_postal" value="'.$datosEnvio["cod_postal"].'" placeholder="Introduzca el teléfono de contacto">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="provincia">Provincia</label>'.SALTO_LINEA;
    $html .=  CreaSelect('provincia', $listaProvincias, $datosEnvio["provincia"]);
    $html .= '</div>'.SALTO_LINEA;
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="email">Email</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="email" id="email" value="'.$datosEnvio["email"].'" placeholder="Introduzca dirección de correo electrónico">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    /*
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="fecha_ent">Fecha de entrega</label>'.SALTO_LINEA;
    $html .= '<input type="date" class="form-control" name="fecha_ent" id="fecha_ent" value="'.$datosEnvio["fecha_ent"].'" placeholder="Introduzca la fecha de entrega dd/mm/aaaa">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;
    */
    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="observaciones">Observaciones</label>'.SALTO_LINEA;
    $html .= '<textarea class="form-control" name="observaciones" id="observaciones" placeholder="¿Alguna observación?" rows="3">'.$datosEnvio["observaciones"].'</textarea>'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;

    $html .= '<button type="submit" class="btn btn-default">Enviar</button>'.SALTO_LINEA;
    $html .= '</form>'.SALTO_LINEA;

    return $html;
}

/**
 * Genera un formulario de selección de envío
 * @return string
 */
function GeneraHTMLFormSeleccionar($accion)
{
    $html  = '<form role="form" action="?ctrl=controlador&accion='.$accion.'" method="post">'.SALTO_LINEA;

    $html .= '<div class="form-group">'.SALTO_LINEA;
    $html .= '<label for="cod_envio">Código de envío</label>'.SALTO_LINEA;
    $html .= '<input type="text" class="form-control" name="cod_envio" id="cod_envio" value="'.ValorPost("cod_envio").'" placeholder="Introduzca el código de envío">'.SALTO_LINEA;
    $html .= '</div>'.SALTO_LINEA;

    $html .= '<button type="submit" class="btn btn-default">Enviar</button>'.SALTO_LINEA;
    $html .= '</form>'.SALTO_LINEA;

    return $html;
}

/**
 * Genera el código html de un envío con los datos
 * correspondientes pasados como parámetro
 * @param array $datos
 * @return string
 */
function GeneraHTMLEnvio($datos)
{
    $html = '';

    if($datos) {

        //Aquí según los datos creamos las variables para nuestra vista
        switch(strtoupper($datos['estado']))
        {
            case 'P':
                $estado = 'Pendiente';
                $label  = 'label-primary';
                break;
            case 'E':
                $estado = 'Entregado';
                $label  = 'label-success';
                break;
            case 'D':
                $estado = 'Devuelto';
                $label  = 'label-danger';
                break;
        }

        //Damos la vuelta a las fechas y cambiamos '-' por '/'
        $fecha_crea = join('/', array_reverse(explode('-',$datos['fecha_crea'])));
        $fecha_ent = ($datos['fecha_ent']!=='0000-00-00')?join('/', array_reverse(explode('-',$datos['fecha_ent']))) : 'sin especificar';

        //Comenzamos a generar el html
        $html .= '<div class="panel panel-default envio">' . SALTO_LINEA;
        $html .= '<div class="panel-heading envio-cabecera" role="tab">' . SALTO_LINEA;
        $html .= '<div class="panel-title row">' . SALTO_LINEA;
        $html .= '<div class="col-xs-12">' . SALTO_LINEA;
        $html .= '<span class="badge cod-envio pull-left">#' . $datos["cod_envio"] . '</span>' . SALTO_LINEA;
        $html .= '<div class="actions pull-right">' . SALTO_LINEA;
        $html .= '<a href="#" class="table-link">' . SALTO_LINEA;
        $html .= '<small><span class="glyphicon glyphicon-pencil"></span></small>' . SALTO_LINEA;
        $html .= '</a>' . SALTO_LINEA;
        $html .= '<a href="#" class="table-link danger">' . SALTO_LINEA;
        $html .= '<small><span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#info-detalle'.$datos["cod_envio"].'"></span></small>' . SALTO_LINEA;
        $html .= '</a>' . SALTO_LINEA;
        $html .= '<a href="#" class="table-link danger">' . SALTO_LINEA;
        $html .= '<small><span class="glyphicon glyphicon-trash"></span></small>' . SALTO_LINEA;
        $html .= '</a>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '<div class="panel-body envio-cuerpo">' . SALTO_LINEA;
        $html .= '<div class="container-fluid">' . SALTO_LINEA;
        $html .= '<div class="media pull-left">' . SALTO_LINEA;
        $html .= '<a class="media-left" href="#">' . SALTO_LINEA;
        $html .= '<img class="avatar" src="http://localhost/DWEServidor_prac1ev/assets/img/default-user-picture.png">' . SALTO_LINEA;
        $html .= '</a>' . SALTO_LINEA;
        $html .= '<div class="media-body">' . SALTO_LINEA;
        $html .= '<h3 class="media-heading destinatario">' . $datos['destinatario'] . '</h3>' . SALTO_LINEA;
        $html .= '<span class="texto-azul">' . $datos['provincia'] . '</span>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '<span class="label '.$label.' pull-right">' . $estado . '</span>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;

        //Información adicional que inicialmente está oculta
        $html .= '<a data-toggle="collapse" href="#info-adicional'.$datos["cod_envio"].'" aria-expanded="false" aria-controls="info-adicional"><span class="glyphicon glyphicon-chevron-down pull-right"></span></a>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '<div id="info-adicional'.$datos["cod_envio"].'" class="panel-collapse collapse info-adicional" role="tabpanel" aria-labelledby="envio-cabecera">' . SALTO_LINEA;
        $html .= '<div class="panel-body">' . SALTO_LINEA;
        $html .= '<ul class="list-group">' . SALTO_LINEA;
        $html .= '<li class="list-group-item"><span class="glyphicon glyphicon-phone datos"></span><span class="datos">'.$datos["telefono"].'</span></li>' . SALTO_LINEA;
        $html .= '<li class="list-group-item"><span class="glyphicon glyphicon-map-marker datos"></span><span class="datos">'.$datos["direccion"].', '.$datos["cod_postal"].'  '.$datos["poblacion"].'</span></li>' . SALTO_LINEA;
        $html .= '<li class="list-group-item"><span class="glyphicon glyphicon-envelope datos"></span><span class="datos">'.$datos["email"].'</span></li>' . SALTO_LINEA;
        $html .= '<li class="list-group-item"><span class="glyphicon glyphicon-comment datos"></span><span class="datos">'.$datos["observaciones"].'</span></li>' . SALTO_LINEA;
        $html .= '</ul>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '<div class="panel-footer clearfix">' . SALTO_LINEA;
        $html .= '<div class="col-xs-12">' . SALTO_LINEA;
        $html .= '<small class="pull-left">Creado el <span class="envio-fecha">'.$fecha_crea.'</span></small>' . SALTO_LINEA;
        $html .= '<small class="pull-right">Entregado el <span class="envio-fecha">'.$fecha_ent.'</span></small>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;
        $html .= '</div>' . SALTO_LINEA;

        //Ventana modal con el detalle de cada envío
        $html .= '<div class="modal fade" id="info-detalle'.$datos["cod_envio"].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'.SALTO_LINEA;
        $html .= '<div class="modal-dialog">'.SALTO_LINEA;
        $html .= '<div class="modal-content">'.SALTO_LINEA;
        $html .= '<div class="modal-header">'.SALTO_LINEA;
        $html .= '<button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Close</span></button>'.SALTO_LINEA;
        $html .= '<h4 class="modal-title">Información detallada del envío '.$datos["cod_envio"].'</h4>'.SALTO_LINEA;
        $html .= '</div>'.SALTO_LINEA;
        $html .= '<div class="modal-body">'.SALTO_LINEA;

        //Datos de la ventana modal
        $html .= '<table class="table detalle">'.SALTO_LINEA;
        $html .= '<tbody>';
        $html .= '<tr><th>Destinatario</th><td>'.$datos["destinatario"].'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Teléfono</th><td>'.$datos["telefono"].'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Dirección</th><td>'.$datos["direccion"].'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Población</th><td>'.$datos["poblacion"].'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Código Postal</th><td>'.$datos["cod_postal"].'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Provincia</th><td>'.$datos["provincia"].'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Correo electrónico</th><td>'.$datos["email"].'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Estado</th><td>'.$estado.'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Fecha de creación</th><td>'.$fecha_crea.'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Fecha de entrega</th><td>'.$fecha_ent.'</td></tr>'.SALTO_LINEA;
        $html .= '<tr><th>Observaciones</th><td>'.$datos["observaciones"].'</td></tr>'.SALTO_LINEA;
        $html .= '</tbody>';
        $html .= '</table>';

        $html .= '</div>'.SALTO_LINEA;
        $html .= '<div class="modal-footer">'.SALTO_LINEA;
        $html .= '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>'.SALTO_LINEA;
        //$html .= '<button type="button" class="btn btn-primary">Save changes</button>'.SALTO_LINEA;
        $html .= '</div>'.SALTO_LINEA;
        $html .= '</div>'.SALTO_LINEA;
        $html .= '</div>'.SALTO_LINEA;
        $html .= '</div>'.SALTO_LINEA;
    }
    return $html;
}
?>

<div class="col-md-6 col-sm-12 col-xs-12">

    <div class="col-md-12">
        <div class="panel-group lista-envios" id="accordion" role="tablist" aria-multiselectable="true">

            <h2 class="page-header text-primary" id="titulo-pagina"><?=$tituloPagina?></div>

        <?php
        if($accion==='listar')
        {
            if(isset($mensaje))
            {
                echo '<p>'.$mensaje.'</p>';
            }
            else if (isset($listaEnvios) && $listaEnvios) { //Si esta definida y no está vacía
                foreach ($listaEnvios as $clave => $valor) {
                    echo GeneraHTMLEnvio($valor);
                }
            }
        }
        if($accion==='crear')
        {
            if(isset($mensaje))
            {
                echo '<p>'.$mensaje.'</p>';
            }
            else if(isset($listaProvincias))
            {
                echo GeneraHTMLFormVacio($accion, $listaProvincias);
            }
        }
        if($accion==='editar')
        {

            if(isset($mensaje))
            {
                echo '<p>'.$mensaje.'</p>';
            }
            else if(isset($listaProvincias))
            {
                echo GeneraHTMLFormEditar($datosEnvio, $listaProvincias);
            }
            else
            {
                echo GeneraHTMLFormSeleccionar($accion);
            }
        }
        if($accion==='eliminar')
        {
            if(isset($mensaje))
            {
                echo '<p>'.$mensaje.'</p>';
            }
            else
            {
                echo GeneraHTMLFormSeleccionar($accion);
            }
        }
        if($accion==='anotar_recepcion')
        {
            if(isset($mensaje))
            {
                echo '<p>'.$mensaje.'</p>';
            }
            else
            {
                echo GeneraHTMLFormSeleccionar($accion);
            }
        }
        if($accion==='buscar') {
            if (isset($mensaje)) {
                echo '<p>' . $mensaje . '</p>';
            } else {
                if (isset($listaEnvios)) {
                    foreach ($listaEnvios as $clave => $valor) {
                        echo GeneraHTMLEnvio($valor);
                    }
                } else {
                    echo GeneraHTMLFormVacio($accion, $listaProvincias);
                }
            }
        }
        ?>

    </div>
</div>

</div>