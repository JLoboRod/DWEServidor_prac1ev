<!-- MENÚ NAVEGACIóN -->
<div class="col-xs-4 col-sm-3" id="sidebar" role="navigation">
    <?php if(isset($_SESSION['usuario'])):?>
    <div class="panel bg-gris-claro"  id="menu-navegacion">
        <h4 class="panel-title text-center texto-gris-oscuro titulo-menu">MENÚ PRINCIPAL</h4>
        <ul class="">
            <li>
                <a href="index.php" title="Inicio" data-placement='right'>
                    <span class="glyphicon glyphicon-home"></span>
                    Inicio
                </a>
            </li>
            <li>
                <a href="?opcion=listar">
                    <span class="glyphicon glyphicon-list-alt azul"></span>
                    Listar envíos
                </a>
            </li>
            <li>
                <a href="?opcion=crear">
                    <span class="glyphicon glyphicon-plus"></span>
                    Crear envío
                </a>
            </li>
            <li>
                <a href="?opcion=editar">
                    <span class="glyphicon glyphicon-pencil"></span>
                    Editar envío
                </a>
            </li>
            <li>
                <a href="?opcion=eliminar">
                    <span class="glyphicon glyphicon-trash"></span>
                    Eliminar envío
                </a>
            </li>
            <li>
                <a href="?opcion=anotar_recepcion">
                    <span class="glyphicon glyphicon-book"></span>
                    Anotar recepción
                </a>
            </li>
            <li>
                <a href="?opcion=buscar">
                    <span class="glyphicon glyphicon-search"></span>
                    Buscar envíos
                </a>
            </li>
        </ul>
    </div>
    <?php endif;?>
</div>
