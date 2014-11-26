<?php
/**
 * MODELO PARA PROVINCIAS
 */

// Incluimos el fichero de la capa de abstracción
require_once BASE_DIR.'/models/db.php';

class ModeloProvincias{

    private $db;  //Instancia de la capa de abstracción

    function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Devuelve la lista de provincias
     * @return array
     */
    public function &ListarProvincias()
    {
        $lp = [];
        $rs = $this->db->Consulta("select * from provincias order by cod_provincia");
        while($lp[] = $this->db->LeeRegistro($rs));
        array_pop($lp);

        return $lp;
    }

    /**
     * Devuelve las provincias que cumplen $opciones de búsqueda
     * @param array $condiciones
     */
    public function &BuscarProvincias($condiciones){

        if($condiciones){
            $sql = 'select * from provincias where';
            $cond='';
            foreach($condiciones as $clave => $valor){
                if($cond != '')
                    $cond .= ' and ';
                $cond.= $clave.' like "'.$valor.'"';

            }
            $sql.=' '.$cond;
        }
        else{
            $sql = 'select * from provincias order by cod_provincia';
        }
        $sql .= ' order by cod_provincia';
        /*/DEBUG: Mostramos la sentencia sql
        echo "<pre>";
        print_r($sql);
        echo "</pre>";
        //*/
        $rs = $this->db->Consulta($sql);
        while($lp[] = $this->db->LeeRegistro($rs));
        array_pop($lp);

        return $lp;
    }
}