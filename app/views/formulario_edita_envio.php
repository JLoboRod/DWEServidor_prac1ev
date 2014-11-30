<form role="form" action="<?=$accion?>" method="post">
    <div class="form-group">
        <label for="cod_envio">Código de envío</label>
        <input type="text" class="form-control" name="cod_envio" id="cod_envio" value="<?=$datosEnvio['cod_envio']?>" readonly>
    </div>
    <div class="form-group">
        <label for="destinatario">Destinatario</label>
        <input type="text" class="form-control" name="destinatario" id="destinatario" value="<?=$datosEnvio['destinatario']?>" placeholder="Introduzca el destinatario">
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control" name="telefono" id="telefono" value="<?=$datosEnvio['telefono']?>" placeholder="Introduzca el teléfono de contacto">
    </div>
    <div class="form-group">
        <label for="direccion">Dirección</label>
        <input type="text" class="form-control" name="direccion" id="direccion" value="<?=$datosEnvio['direccion']?>" placeholder="Introduzca la dirección de contacto">
    </div>
    <div class="form-group">
        <label for="poblacion">Población</label>
        <input type="text" class="form-control" name="poblacion" id="poblacion" value="<?=$datosEnvio['poblacion']?>" placeholder="Introduzca el población">
    </div>
    <div class="form-group">
        <label for="cod_postal">Código Postal</label>
        <input type="text" class="form-control" name="cod_postal" id="cod_postal" value="<?=$datosEnvio['cod_postal']?>" placeholder="Introduzca el teléfono de contacto">
    </div>
    <div class="form-group">
        <label for="provincia">Provincia</label>
        <?=CreaSelect('provincia', $listaProvincias, $datosEnvio['provincia'])?>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?=$datosEnvio['email']?>" placeholder="Introduzca dirección de correo electrónico">
    </div>
    <div class="form-group">
        <label for="observaciones">Observaciones</label>
        <textarea class="form-control" name="observaciones" id="observaciones" placeholder="¿Alguna observación?" rows="3"><?=$datosEnvio['observaciones']?></textarea>
    </div>
    <button type="submit" class="btn btn-default">Enviar</button>
</form>