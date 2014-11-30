<form role="form" action="<?=$accion?>" method="post">
    <div class="form-group">
        <label for="destinatario">Destinatario</label>
        <input type="text" class="form-control" name="destinatario" id="destinatario" value="<?=ValorPost('destinatario')?>" placeholder="Introduzca el destinatario">
    </div>
    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control" name="telefono" id="telefono" value="<?=ValorPost('telefono')?>" placeholder="Introduzca el teléfono de contacto">
    </div>
    <div class="form-group">
        <label for="direccion">Dirección</label>
        <input type="text" class="form-control" name="direccion" id="direccion" value="<?=ValorPost('direccion')?>" placeholder="Introduzca la dirección de contacto">
    </div>
    <div class="form-group">
        <label for="poblacion">Población</label>
        <input type="text" class="form-control" name="poblacion" id="poblacion" value="<?=ValorPost('poblacion')?>" placeholder="Introduzca el población">
    </div>
    <div class="form-group">
        <label for="cod_postal">Código Postal</label>
        <input type="text" class="form-control" name="cod_postal" id="cod_postal" value="<?=ValorPost('cod_postal')?>" placeholder="Introduzca el teléfono de contacto">
    </div>
    <div class="form-group">
        <label for="provincia">Provincia</label>
        <?=CreaSelect('provincia', $listaProvincias, ValorPost('provincia'))?>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?=ValorPost('email')?>" placeholder="Introduzca dirección de correo electrónico">
    </div>
    <div class="form-group">
        <label for="observaciones">Observaciones</label>
        <textarea class="form-control" name="observaciones" id="observaciones" value="<?=ValorPost('observaciones')?>" placeholder="¿Alguna observación?" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-default">Enviar</button>
</form>