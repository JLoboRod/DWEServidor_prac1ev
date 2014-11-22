<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Vista</title>
</head>
<body>
	<?=CargarVista(BASE_DIR.'/views/encabezado.php');?>
	<?=CargarVista(BASE_DIR.'/views/menu_navegacion.php');?>
	<?=$htmlCuerpo?> Generado por el controlador previamente
	<?=CargarVista(BASE_DIR.'/views/pie.php'); ?>
</body>
</html>

<!--
##PARA ENVIAR POR GET Y POR POST A LA VEZ###
<form action="?action=edit&id=xxx"></form>
-->