<form role="form" action="<?=$accion?>" method="post">
    <p>Confirmación de eliminación</p>
    <input type="hidden" name="oculto" value="<?=$dato?>">

    <button type="submit" name="si" class="btn btn-default">Sí</button>
    <button type="submit" name="no" class="btn btn-default">No</button>
</form>