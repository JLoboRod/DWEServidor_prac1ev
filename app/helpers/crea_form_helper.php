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

function CreaSelect($name, $opciones, $valorDefecto=0)
{
    $html = '';

    if(is_array($opciones)) {
        $html  = "\n" . '<select class="form-control" id="' . $name . '" name="' . $name . '">' ."\n";
        //Vamos a crear un option vacío para que no haya una provincia seleccionada inicialmente
        $html .= '<option value="00" selected="selected"></option>'. "\n";

        foreach ($opciones as $id => $provincia) {
            if (($id) == $valorDefecto)
                $select = 'selected="selected"';
            else
                $select = "";

            //Hacemos lo siguiente ya que el cod_provincia es de tipo char(2)
            $html .= "\n\t".'<option value="'.$id.'" '.$select.'>'.$provincia.'</option>';
        }
        $html .= "\n</select>";
    }
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

function CreaInputText($name, $valorPorDefecto)
{
    $html  = '<br/>';
    $html .= '<input type="text" class="form-control" name="'.$name.'" placeholder="Introduzca '.$name.'">';
    $html .= '<br/>';
}

function CreaControlesFormulario($datos)
{
    $html = '';

    foreach($datos as $control){

        switch ($control['tipo']){
            case 'text':
                $html .= '<div class="form-group">';
                $html .= '<label for="'.$control["campo"].'">'.$control["texto_pregunta"].'</label>'.SALTO_LINEA;
                $html .= CreaInputText($control['campo'], ValorPost($control['campo']));
                $html .= '</div>';
                break;
            case 'radiobutton':
                $html .= '<div class="form-group">';
                $html .= $control['texto_pregunta'];
                $html .= CreaRadioButton($control['campo'], $control['respuestas'], ValorPost($control['campo'], $control['respuestas'][0]));
                $html .= '</div>';
                break;
            case 'checkbox':
                $html .= '<div class="form-group">';
                $html .= $control['texto_pregunta'];
                $html .= CreaCheckBox($control['campo'].'[]', $control['respuestas'], ValoresPost($control['campo']));
                $html .= '</div>';
                break;
            case 'select':
                $html .= '<div class="form-group">';
                $html .= '<label for="'.$control["campo"].'">'.$control["texto_pregunta"].'</label>'.SALTO_LINEA;
                $html .= CreaSelect($control["campo"], $control["respuestas"], ValorPost($control["campo"]));
                $html .= '</div>';
                break;
            default:
                $html='<p class="texto-rojo">ERROR: No se pudo crear el formulario...</p>';
                break;
        }

        //$html.=VerError($control['campo']); //En caso de filtrar/validar datos
    }
    $html.= '<button type="submit" class="btn btn-default">Enviar</button>';

    return $html;
}


