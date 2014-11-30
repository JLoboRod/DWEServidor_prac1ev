<div class="panel panel-default envio">
    <div class="panel-heading envio-cabecera" role="tab">
        <div class="panel-title row">
            <div class="col-xs-12">
                <span class="badge cod-envio pull-left"><?=$envio["cod_envio"]?></span>
                <div class="actions pull-right">
                    <a href="#" class="table-link">
                        <small><span class="glyphicon glyphicon-pencil"></span></small>
                    </a>
                    <a href="#" class="table-link danger">
                        <small><span class="glyphicon glyphicon-eye-open" data-toggle="modal" data-target="#info-detalle<?=$envio["cod_envio"]?>"></span></small>
                    </a>
                    <a href="#" class="table-link danger">
                        <small><span class="glyphicon glyphicon-trash"></span></small>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body envio-cuerpo">
        <div class="container-fluid">
            <div class="media pull-left">
                <a class="media-left" href="#">
                    <img class="avatar" src="http://localhost/DWEServidor_prac1ev/assets/img/default-user-picture.png">
                </a>
                <div class="media-body">
                    <h3 class="media-heading destinatario"><?=$envio['destinatario']?></h3>
                    <span class="texto-azul"><?=$envio['provincia']?></span>
                </div>
            </div>
            <span class="label <?=$envio['estadoLabel']?> pull-right"><?=$envio['estado']?></span>
        </div>
        <a data-toggle="collapse" href="#info-adicional<?=$envio["cod_envio"]?>" aria-expanded="false" aria-controls="info-adicional"><span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
    </div>
    <div id="info-adicional<?=$envio["cod_envio"]?>" class="panel-collapse collapse info-adicional" role="tabpanel" aria-labelledby="envio-cabecera">
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item"><span class="glyphicon glyphicon-phone datos"></span><span class="datos"><?=$envio["telefono"]?></span></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-map-marker datos"></span><span class="datos"><?=$envio["direccion"]?>, <?=$envio["cod_postal"]?>  <?=$envio["poblacion"]?></span></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-envelope datos"></span><span class="datos"><?=$envio["email"]?></span></li>
                <li class="list-group-item"><span class="glyphicon glyphicon-comment datos"></span><span class="datos"><?=$envio["observaciones"]?></span></li>
            </ul>
        </div>
    </div>
    <div class="panel-footer clearfix">
        <div class="col-xs-12">
            <small class="pull-left">Creado el <span class="envio-fecha"><?=$envio['fecha_crea']?></span></small>
            <small class="pull-right">Entregado el <span class="envio-fecha"><?=$envio['fecha_ent']?></span></small>
        </div>
    </div>
</div>

<div class="modal fade" id="info-detalle<?=$envio["cod_envio"]?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Información detallada del envío <?=$envio["cod_envio"]?></h4>
            </div>
            <div class="modal-body">
                <table class="table detalle">
                    <tbody>
                        <tr><th>Destinatario</th><td><?=$envio["destinatario"]?></td></tr>
                        <tr><th>Teléfono</th><td><?=$envio["telefono"]?></td></tr>
                        <tr><th>Dirección</th><td><?=$envio["direccion"]?></td></tr>
                        <tr><th>Población</th><td><?=$envio["poblacion"]?></td></tr>
                        <tr><th>Código Postal</th><td><?=$envio["cod_postal"]?></td></tr>
                        <tr><th>Provincia</th><td><?=$envio["provincia"]?></td></tr>
                        <tr><th>Correo electrónico</th><td><?=$envio["email"]?></td></tr>
                        <tr><th>Estado</th><td><?=$envio['estado']?></td></tr>
                        <tr><th>Fecha de creación</th><td><?=$envio['fecha_crea']?></td></tr>
                        <tr><th>Fecha de entrega</th><td><?=$envio['fecha_ent']?></td></tr>
                        <tr><th>Observaciones</th><td><?=$envio["observaciones"]?></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

