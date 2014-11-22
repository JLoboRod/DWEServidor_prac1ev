<?php

/**
 * Carga el fichero indicado en $ruta y lo procesa como si
 * hiciésemos include en el que se han declarado todas las
 * variables que incluye el array $datosVista
 * @param string $ruta
 * @param array $datosVista
 * @return string
 */
function &CargarVista($ruta, $datosVista=[]){
	
	//Comprobamos si existe el fichero de la vista
	if(!file_exists($ruta)){
		$htmlError = '<div>No existe: $ruta</div>'; //No podemos incluir nada
		return $htmlError;
	}
	
	//Creamos datos que hemos pasado en el array
	foreach($datosVista as $claveDatoVista => $valorDatoVista){
		$$claveDatoVista = $valorDatoVista; 
	}
	
	//Interpretamos la plantilla
	ob_start(); //Interrumpimos el flujo de entrada
	include($ruta); 
	$html = ob_get_clean(); //Guardamos la plantilla en una variable
	
	return $html;
}