<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vista</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/DWEServidor_prac1ev/assets/css/bootstrap.min.css">
</head>
<body>
	<?=CargarVista(BASE_DIR.'/views/encabezado.php');?>
	<?=CargarVista(BASE_DIR.'/views/menu_navegacion.php');?>
	<?=$htmlCuerpo?> Generado por el controlador previamente
	<?=CargarVista(BASE_DIR.'/views/pie.php'); ?>

    <!-- Los scripts aquí para acelerar la carga de la página -->
    <script src="http://localhost/DWEServidor_prac1ev/assets/js/jquery-2.1.1.js"></script>
    <script src="http://localhost/DWEServidor_prac1ev/assets/js/bootstrap.min.js"></script>
</body>
</html>

<!--
##PARA ENVIAR POR GET Y POR POST A LA VEZ###
<form action="?action=edit&id=xxx"></form>
-->