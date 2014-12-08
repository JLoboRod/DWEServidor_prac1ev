<?php
/**
 * MODELO PARA USUARIOS
 */

// Incluimos el fichero de la capa de abstracción
require_once BASE_DIR.'/models/db.php';

class ModeloUsuarios{

    private $db;  //Instancia de la capa de abstracción

    function __construct()
    {
        $this->db = Db::getInstance();
    }

    /**
     * Devuelve el número de usuarios que cumplen $condiciones
     * @return integer
     */
    public function NumUsuarios($condiciones=NULL)
    {
        if($condiciones){
            $sql = 'select count(*) as total from usuarios where';
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
            $sql = 'select count(*) as total from usuarios';
        }
        $rs = $this->db->Consulta($sql);

        return $this->db->LeeRegistro($rs)['total'];
    }

    /**
     * Devuelve la lista de usuarios
     * @return array
     */
    public function &ListarUsuarios($inic='', $porPag='')
    {
        $lu = [];
        if($inic!=='' && $porPag!=='')
        {
            $rs = $this->db->Consulta("select * from usuarios limit ".$inic.",".$porPag);
        }
        else
        {
            $rs = $this->db->Consulta("select * from usuarios");
        }
        while($lu[] = $this->db->LeeRegistro($rs));
        array_pop($lu);

        return $lu;
    }

    /**
     * Crea nuevo usuario con $datos
     * @param array $datos
     */
    public function CrearUsuario($datos)
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
        $sql = 'insert into usuarios '.$campos.' values '.$valores;

        /*/DEBUG: Mostramos la sentencia sql
        echo "<pre>";
        print_r($sql);
        echo "</pre>";
        //*/
        $this->db->Consulta($sql);
    }


    /**
     * Edita los datos del usuario $id
     * @param integer $id
     * @param array $datos
     */
    public function EditarUsuario($usuario, $datos)
    {
        $updates=[];
        foreach($datos as $clave=>$valor)
        {
            $updates[] = $clave." = '".$valor."'";
        }

        //Elaboramos ambas partes de la sentencia sql
        $updates = join(',', $updates);

        //Creamos la sentencia sql con ambas partes
        $sql = 'update usuarios set '.$updates.' where usuario ="'. $usuario.'"';

        /*/DEBUG: Mostramos la sentencia sql
        echo "<pre>";
        print_r($sql);
        echo "</pre>";
        //*/
        $this->db->Consulta($sql);
    }

    /**
     * Elimina el usuario $id
     * @param integer $id
     */
    public function EliminarUsuario($usuario){
        $sql = 'delete from usuarios where usuario = "'.$usuario.'"';

        /*/DEBUG: Mostramos la sentencia sql
        echo "<pre>";
        print_r($sql);
        echo "</pre>";
        //*/
        $this->db->Consulta($sql);
    }

    /**
     * Devuelve los usuarios que cumplen $opciones de búsqueda
     * @param array $condiciones
     */
    public function &BuscarUsuarios($condiciones){

        if($condiciones){
            $sql = 'select * from usuarios where';
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
            $sql = 'select * from usuarios';
        }

        /*/DEBUG: Mostramos la sentencia sql
        echo "<pre>";
        print_r($sql);
        echo "</pre>";
        //*/
        $rs = $this->db->Consulta($sql);
        while($lu[] = $this->db->LeeRegistro($rs));
        array_pop($lu);

        return $lu;
    }

    public function &BuscarUsuario($usuario)
    {
        $sql = 'select * from usuarios where usuario like '.'"'.$usuario.'"';
        $rs = $this->db->Consulta($sql);
        $lu = $this->db->LeeRegistro($rs);
        return $lu;
    }
}