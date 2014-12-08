<!-- MENÚ NAVEGACIóN -->
<div class="col-xs-4 col-sm-3" id="sidebar" role="navigation">
    <?php if(isset($_SESSION['usuario'])):?>
    <div class="panel bg-gris-claro"  id="menu-navegacion">
        <h4 class="panel-title text-center texto-gris-oscuro titulo-menu">MENÚ USUARIOS</h4>
        <ul class="">
            <li>
                <a id="" class="is-menu" href="?opcion=listar_usuarios">
                    <span class="glyphicon glyphicon-list-alt azul"></span>
                    Listar usuarios
                </a>
            </li>
            <li>
                <a id="" class="is-menu" href="?opcion=crear_usuario">
                    <span class="glyphicon glyphicon-plus"></span>
                    Crear usuario
                </a>
            </li>
            <li>
                <a id="" class="is-menu" href="?opcion=editar_usuario">
                    <span class="glyphicon glyphicon-pencil"></span>
                    Editar usuario
                </a>
            </li>
            <li>
                <a id="" class="is-menu" href="?opcion=eliminar_usuario">
                    <span class="glyphicon glyphicon-trash"></span>
                    Eliminar usuario
                </a>
            </li>
        </ul>
    </div>
    <?php endif;?>
</div>