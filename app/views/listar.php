<?php
foreach ($listaEnvios as $envio) 
{
    echo CargarVista(BASE_DIR . '/views/envio.php', 
    	array(
			'envio'	=> $envio
    		));
    echo "<br/>";
}