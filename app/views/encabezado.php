<!-- CABECERA -->
<header class="navbar navbar-fixed-top" id="cabecera" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <span class="glyphicon glyphicon-globe"></span>
                <b>KeNoLLega S.L.</b>
            </a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">
                <?php if(!isset($_SESSION['usuario'])):?>
                <li>
                    <a href="?opcion=acceder">
                        <i class="glyphicon glyphicon-log-in"></i>
                        Acceder
                    </a>
                </li>
                <?php else :?>
                <li>
                    <span class="navbar-text">
                        <strong><?=$_SESSION['usuario']?></strong>, hora de conexión: <?=date('G:i:s', $_SESSION['hora'])?>
                    </span>
                </li>
                <li>
                    <a href="?opcion=salir">
                        <i class="glyphicon glyphicon-log-out"></i>
                        Salir
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </nav>
    </div>
</header>