<?php

	echo '<pre>';
	print_r($listaEnvios);
	echo '</pre>';
	
	foreach ($listaEnvios as $clave => $valor){
		
		$preguntas = array(
			[
				'texto_pregunta' => 'Datos del envío',
				'tipo' => 'select',
				'campo' => 'info',
				'respuestas' => $valor
			]
		);
	
		echo GetHTMLPregunta($preguntas);
		
		echo '<pre>';
		print_r($preguntas);
		echo '</pre>';
		
	}