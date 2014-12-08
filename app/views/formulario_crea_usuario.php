<form role="form" action="<?=$accion?>" method="post">
    <div class="form-group <?=(isset($claseCampoForm['usuario']))?$claseCampoForm['usuario']:''?>">
        <label class="control-label" for="usuario">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario" value="<?=ValorPost('usuario')?>" placeholder="Introduzca el usuario">
        <span class="help-block"><?=(isset($errores['usuario']))?$errores['usuario']:''?></span>
    </div>
    <div class="form-group <?=(isset($claseCampoForm['password']))?$claseCampoForm['password']:''?>">
        <label class="control-label" for="password">Password</label>
        <input type="text" class="form-control" name="password" id="password" value="<?=ValorPost('password')?>" placeholder="Introduzca el password">
        <span class="help-block"><?=(isset($errores['password']))?$errores['password']:''?></span>
    </div>

    <button type="submit" class="btn btn-default">Enviar</button>
</form>