<?php
/**
 * MODELO PARA ENVÍOS
 */

// Incluimos el fichero de la capa de abstracción
require_once BASE_DIR.'/models/db.php';

class ModeloEnvios{

    private $db;  //Instancia de la capa de abstracción

    function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Devuelve el número de envíos que cumplen $condiciones
     * @return integer
     */
    public function NumEnvios($condiciones=NULL)
    {
        if($condiciones){
            $sql = 'select count(*) as total from envios where';
            $cond='';

            if(is_array($condiciones)) {
                foreach ($condiciones as $clave => $valor) {
                    if ($cond != '')
                        $cond .= ' and ';
                    $cond .= $clave . ' like "' . $valor . '"';

                }
            }
            $sql.=' '.$cond;
        }
        else{
            $sql = 'select count(*) as total from envios';
        }
        $rs = $this->db->Consulta($sql);

        return $this->db->LeeRegistro($rs)['total'];

    }

    /**
     * Devuelve la lista de envíos
     * @return array
     */
    public function &ListarEnvios($inic='', $porPag='')
    {
        $le = [];
        if($inic!=='' && $porPag!=='')
        {
            $rs = $this->db->Consulta("select * from envios order by fecha_crea desc limit ".$inic.",".$porPag);
            //$rs = $this->db->Consulta("select * from envios limit ".$inic.",".$porPag);
        }
        else
        {
            $rs = $this->db->Consulta("select * from envios order by fecha_crea desc");
            //$rs = $this->db->Consulta("select * from envios");

        }
        while($le[] = $this->db->LeeRegistro($rs));
        array_pop($le);

        return $le;
    }

    /**
     * Inserta nuevo envío con $datos
     * @param array $datos
     */
    public function CrearEnvio($datos)
    {
        $campos = [];
        $valores = [];
        foreach($datos as $clave=>$valor)
        {
            $campos[] = $clave;
            $valores[] = "'".$valor."'"; //Aquí añadimos las comillas porque son string. Los números con comillas los acepta igual
        }

        //Elaboramos ambas partes de la sentencia sql
        $campos = '('.join(',', $campos).')';
        $valores = '('.join(',', $valores).')';

        //Creamos la sentencia sql
        $sql = 'insert into envios '.$campos.' values '.$valores;

        /*/DEBUG: Mostramos la sentencia sql
        echo "<pre>";
        print_r($sql);
        echo "</pre>";
        //*/

        $this->db->Consulta($sql);
    }


    /**
     * Edita los datos del envío $id
     * @param integer $id
     * @param array $datos
     */
    public function EditarEnvio($id, $datos)
    {
        $updates=[];
        foreach($datos as $clave=>$valor)
        {
            $updates[] = $clave." = '".$valor."'";
        }

        //Elaboramos ambas partes de la sentencia sql
        $updates = join(',', $updates);

        //Creamos la sentencia sql con ambas partes
        $sql = 'update envios set '.$updates.' where cod_envio ='. $id;

        /*/DEBUG: Mostramos la sentencia sql
        echo "<pre>";
        print_r($sql);
        echo "</pre>";
        //*/
        $this->db->Consulta($sql);
    }

    /**
     * Elimina el envío $id
     * @param integer $id
     */
    public function EliminarEnvio($id){
        $sql = 'delete from envios where cod_envio = '.$id;

        /*/DEBUG: Mostramos la sentencia sql
        echo "<pre>";
        print_r($sql);
        echo "</pre>";
        //*/
        $this->db->Consulta($sql);
    }

    /**
     * Devuelve los envíos que cumplen $opciones de búsqueda
     * @param array $condiciones
     */
    public function &BuscarEnvios($condiciones){

        if($condiciones){
            $sql = 'select * from envios where';
            $cond='';

            if(is_array($condiciones)) {
                foreach ($condiciones as $clave => $valor) {
                    if ($cond != '')
                        $cond .= ' and ';
                    $cond .= $clave . ' like "' . $valor . '"';

                }
            }
            $sql.=' '.$cond;
        }
        else{
            $sql = 'select * from envios';
        }

        $sql .= ' order by fecha_crea desc';
        //DEBUG: Mostramos la sentencia sql
        echo "<pre>";
        print_r($sql);
        echo "</pre>";
        //*/
        $rs = $this->db->Consulta($sql);
        while($le[] = $this->db->LeeRegistro($rs));
        array_pop($le);

        return $le;
    }
}