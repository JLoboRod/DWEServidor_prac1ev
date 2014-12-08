<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KeNoLLega S.L.</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/estilos.css">
</head>
<body>

<?=CargarVista(APP_DIR.'/views/encabezado.php');?>
<div class="col-xs-12 col-xs-center contenedor-cuerpo">
    <?=CargarVista(APP_DIR.'/views/menu_navegacion.php');?>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="col-md-12">
            <div class="panel-group lista-envios" id="accordion" role="tablist" aria-multiselectable="true">
                <?=$htmlCuerpo?>
            </div>
        </div>
    </div>
    <?=CargarVista(APP_DIR.'/views/menu_usuarios.php');?>
</div>
<?=CargarVista(APP_DIR.'/views/pie.php'); ?>

<!-- Los scripts aquí para acelerar la carga de la página -->
<script src="http://localhost/DWEServidor_prac1ev/assets/js/jquery-2.1.1.js"></script>
<script src="http://localhost/DWEServidor_prac1ev/assets/js/bootstrap.min.js"></script>
</body>
</html>