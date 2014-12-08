<?php
foreach ($listaEnvios as $envio) 
{
    echo CargarVista(APP_DIR . '/views/envio.php',
    	array(
			'envio'	=> $envio
    		));
    echo "<br/>";
}