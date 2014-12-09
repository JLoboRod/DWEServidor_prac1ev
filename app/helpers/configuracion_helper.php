<?php
/**
 * Helper que nos ayuda a abstraernos de los parámetros de configuración
 */

//TODO: Sujeto a cambios

/**
 * Función que devuelve el parámetro de configuración
 * especificado en $name
 * @param $name
 * @return mixed
 */
function GetConfigValue($name)
{
    return $GLOBALS[$name];
}