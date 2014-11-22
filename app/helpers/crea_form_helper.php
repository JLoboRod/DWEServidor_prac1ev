<?php

/**
 *
 * @param string $nombreCampo
 * @param string $valorPorDefecto
 * @return string
 */
function ValorPost($nombreCampo, $valorPorDefecto='')
{
	if (isset($_POST[$nombreCampo]))
		return $_POST[$nombreCampo];
	else
		return $valorPorDefecto;
}

/**
 *
 * @param string $nombreCampo
 * @param string $valorPorDefecto
 * @return string
 */
function ValoresPost($nombreCampo, $valorPorDefecto=array())
{
    if (isset($_POST[$nombreCampo]))
        return $_POST[$nombreCampo];
    else
        return $valorPorDefecto;
}

/**
 *
 * @param string $nombreCampo
 * @param string $valorPorDefecto
 * @return string
 */
function ValorGet($nombreCampo, $valorPorDefecto='')
{
	if (isset($_GET[$nombreCampo]))
		return $_GET[$nombreCampo];
	else
		return $valorPorDefecto;
}

/**
 *
 * @param string $name Nombre del campo
 * @param array $opciones Opciones que tiene el select
 * 			clave array=valor option
 * 			valor array=texto option
 * @param string $valorDefecto Valor seleccionado
 * @return string
 */
function CreaSelect($name, $opciones, $valorDefecto)
{
	$html="\n".'<select name="'.$name.'" style="margin: 0 10px;">';
	foreach($opciones as $value=>$text)
	{
		if ($value==$valorDefecto)
			$select='selected="selected"';
		else
			$select="";
		$html.= "\n\t<option value=\"$value\" $select>$text</option>";
	}
	$html.="\n</select>";

	return $html;
}

/**
 * Crea un radio button con las opciones pasadas como parámetros
 * @param string $name
 * @param array $opciones
 * @param string $valorDefecto
 * @return string
 */
function CreaRadioButton($name, $opciones, $valorDefecto)
{
	$html="\n";
	for ($i = 0; $i < count($opciones); $i++) {
		$html.='<input type="radio" name="'.$name.'" value="'.$opciones[$i].'"';
		if ($opciones[$i]==$valorDefecto)
		{
			$html.=' checked="checked"';
		}
		$html.=' > '.$opciones[$i];
	}
	$html.="<br/><br/>";

	return $html;
}

/**
 * Crea un checkBox con las opciones pasadas como parámetros
 * @param string $name
 * @param array $opciones
 * @param string $valorDefecto
 * @return string
 */
function CreaCheckBox($name, $opciones, $valoresDefecto)
{
	$html="<br/>";
	for ($i = 0; $i < count($opciones); $i++) {
		$html.='<input type="checkbox" name="'.$name.'" value="'.$opciones[$i].'"';

		if (in_array($opciones[$i], $valoresDefecto))
		{
			$html.=' checked="checked"';
		}
		$html.=' >'.$opciones[$i].'<br/>';

	}
	$html.="<br/>";

	return $html;
}

function GetHTMLPregunta($pre)
{
	$html = '';

	foreach($pre as $control){

		$html.= $control['texto_pregunta'];

		switch ($control['tipo']){
			case 'radiobutton':
				$html.= CreaRadioButton($control['campo'], $control['respuestas'], ValorPost($control['campo'], $control['respuestas'][0]));
				break;
			case 'checkbox':
				$html.= CreaCheckBox($control['campo'].'[]', $control['respuestas'], ValoresPost($control['campo']));
				break;
			case 'select':
				$html.= CreaSelect($control['campo'], $control['respuestas'], ValorPost($control['campo']));
				break;
			default:
				$html="<p style='color: red;'>ERROR: No se pudo crear el formulario...</p>";
				break;
		}
		//$html.=VerError($control['campo']); //En caso de filtrar/validar datos
	}
	$html.= '<input type="submit" value="Enviar">';

	return $html;
}

