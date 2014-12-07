<form role="form" action="<?=$accion?>" method="post">

    <div class="form-group <?=$claseCampoForm['cod_envio']?>">
        <label class="control-label" for="cod_envio">Código de envío</label>
        <input type="text" class="form-control" name="cod_envio" id="cod_envio" placeholder="Introduzca el código de envío" value="<?=ValorPost('cod_envio')?>">
        <span class="help-block"><?=(isset($errores['cod_envio']))?$errores['cod_envio']:''?></span>
    </div>

    <button type="submit" class="btn btn-default">Enviar</button>
</form>