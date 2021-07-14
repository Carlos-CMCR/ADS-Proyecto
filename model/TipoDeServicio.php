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

}

?>