<table class="table table-hover">
    <thead>
        <tr>
            <th><strong>Usuario</strong></th>
            <th><strong>Password</strong></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listaUsuarios as $usuario):?>
        <tr>
            <td>
                <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == $usuario['usuario']) :?>
                    <span class="glyphicon glyphicon-log-in"></span>
                <?php endif;?>
                <?=$usuario['usuario']?>
            </td>
            <td><?=$usuario['password']?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>