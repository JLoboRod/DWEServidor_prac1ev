<form role="form" action="<?=$accion?>" method="post">
    <div class="form-group <?=$claseCampoForm['cod_envio']?>">
        <label for="cod_envio">Código de envío</label>
        <input type="text" class="form-control" name="cod_envio" id="cod_envio" value="<?=$datosEnvio['cod_envio']?>" readonly>
        <span class="help-block"><?=(isset($errores['cod_envio']))?$errores['cod_envio']:''?></span>
    </div>
    <div class="form-group <?=$claseCampoForm['destinatario']?>">
        <label for="destinatario">Destinatario</label>
        <input type="text" class="form-control" name="destinatario" id="destinatario" value="<?=$datosEnvio['destinatario']?>" placeholder="Introduzca el destinatario">
        <span class="help-block"><?=(isset($errores['destinatario']))?$errores['destinatario']:''?></span>
    </div>
    <div class="form-group <?=$claseCampoForm['telefono']?>">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control" name="telefono" id="telefono" value="<?=$datosEnvio['telefono']?>" placeholder="Introduzca el teléfono de contacto">
        <span class="help-block"><?=(isset($errores['telefono']))?$errores['telefono']:''?></span>
    </div>
    <div class="form-group <?=$claseCampoForm['direccion']?>">
        <label for="direccion">Dirección</label>
        <input type="text" class="form-control" name="direccion" id="direccion" value="<?=$datosEnvio['direccion']?>" placeholder="Introduzca la dirección de contacto">
        <span class="help-block"><?=(isset($errores['direccion']))?$errores['direccion']:''?></span>
    </div>
    <div class="form-group <?=$claseCampoForm['poblacion']?>">
        <label for="poblacion">Población</label>
        <input type="text" class="form-control" name="poblacion" id="poblacion" value="<?=$datosEnvio['poblacion']?>" placeholder="Introduzca el población">
        <span class="help-block"><?=(isset($errores['poblacion']))?$errores['poblacion']:''?></span>
    </div>
    <div class="form-group <?=$claseCampoForm['cod_postal']?>">
        <label for="cod_postal">Código Postal</label>
        <input type="text" class="form-control" name="cod_postal" id="cod_postal" value="<?=$datosEnvio['cod_postal']?>" placeholder="Introduzca el teléfono de contacto">
        <span class="help-block"><?=(isset($errores['cod_postal']))?$errores['cod_postal']:''?></span>
    </div>
    <div class="form-group <?=$claseCampoForm['provincia']?>">
        <label for="provincia">Provincia</label>
        <?=CreaSelect('provincia', $listaProvincias, $datosEnvio['provincia'])?>
        <span class="help-block"><?=(isset($errores['provincia']))?$errores['provincia']:''?></span>
    </div>
    <div class="form-group <?=$claseCampoForm['email']?>">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?=$datosEnvio['email']?>" placeholder="Introduzca dirección de correo electrónico">
        <span class="help-block"><?=(isset($errores['email']))?$errores['email']:''?></span>
    </div>
    <div class="form-group <?=$claseCampoForm['observaciones']?>">
        <label for="observaciones">Observaciones</label>
        <textarea class="form-control" name="observaciones" id="observaciones" placeholder="¿Alguna observación?" rows="3"><?=$datosEnvio['observaciones']?></textarea>
        <span class="help-block"><?=(isset($errores['observaciones']))?$errores['observaciones']:''?></span>
    </div>
    <button type="submit" class="btn btn-default">Enviar</button>
</form>