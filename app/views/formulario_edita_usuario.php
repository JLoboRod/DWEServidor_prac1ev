<form role="form" action="<?=$accion?>" method="post">
    <div class="form-group <?=(isset($claseCampoForm['password']))?$claseCampoForm['password']:''?>">
        <label class="control-label" for="password">Nuevo password</label>
        <input type="text" class="form-control" name="password" id="password" value="<?=ValorPost('password')?>" placeholder="Introduzca el password">
        <span class="help-block"><?=(isset($errores['password']))?$errores['password']:''?></span>
    </div>

    <button type="submit" class="btn btn-default">Enviar</button>
</form>