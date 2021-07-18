<?php 
require_once __DIR__."/Conexion.php";
class TipoDeServicio extends Conexion{
    private $bd = null;
    public function __construct(){
        parent::__construct();
        $this->bd = $this->conectar();
    }

    public function listarServicios() {
        try {
            $this->bd = $this->conectar();
            $query = "SELECT * FROM tipodeservicios";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();

            return $consulta->fetchAll();

        }catch(Exception $ex){
            return $ex->getMessage();
        }finally{
            $this->bd = null;
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
            $this->bd = $this->conectar();
            $consulta = $this->bd->prepare($query);
            $consulta->execute();
            return $consulta->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        finally {
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }

}

?>