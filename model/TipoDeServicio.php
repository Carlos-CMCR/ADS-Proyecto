<?php 
require_once __DIR__."/ConexionSingleton.php";
class TipoDeServicio{
    private $bd = null;
    

    public function listarServicios() {
        try {
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT * FROM tipodeservicios";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();

            return $consulta->fetchAll();

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function obtenerPrecioUnitaciosServicios($idDeProductos = []){
        try {
            $query = "select precioDeServicio,id_tipo from tipodeservicios WHERE id_tipo IN (";

            foreach ($idDeProductos as $key) {
                $query.=(int)$key;
                $query.=",";
            }
            $query = substr($query, 0, -1).")";
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $consulta = $this->bd->prepare($query);
            $consulta->execute();
            return $consulta->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

}

?>