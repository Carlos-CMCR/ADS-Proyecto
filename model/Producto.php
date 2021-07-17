<?php 
require_once __DIR__."/Conexion.php";
class Proforma extends Conexion{
    private $bd = null;
    public function __construct(){
        parent::__construct();
        $this->bd = $this->conectar();
    }

    public function obtenerProducto(){
        

    }

}
?>