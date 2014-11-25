<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KeNoLLega S.L.</title>
    <link rel="shortcut icon" type="image/x-icon" href="http://localhost/DWEServidor_prac1ev/assets/img/favicon.ico">
    <link rel="icon" type="image/x-icon" href="http://localhost/DWEServidor_prac1ev/assets/img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="http://localhost/DWEServidor_prac1ev/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/DWEServidor_prac1ev/assets/css/estilos.css">
</head>
<body>

        <?=CargarVista(BASE_DIR.'/views/encabezado.php');?>
        <div class="col-xs-12 col-xs-center">
        <?=CargarVista(BASE_DIR.'/views/menu_navegacion.php');?>
        <?=$htmlCuerpo?>
        </div>
        <?=CargarVista(BASE_DIR.'/views/pie.php'); ?>
        <!-- Los scripts aquí para acelerar la carga de la página -->
        <script src="http://localhost/DWEServidor_prac1ev/assets/js/jquery-2.1.1.js"></script>
        <script src="http://localhost/DWEServidor_prac1ev/assets/js/bootstrap.min.js"></script>
        <script>
            $(function () {
                $('#menu-navegacion li').click(function () {
                    $(this).addClass('active').siblings().removeClass('active');
                });
            });
        </script>
</body>
</html>
<!--
##PARA ENVIAR POR GET Y POR POST A LA VEZ###
<form action="?action=edit&id=xxx"></form>
-->