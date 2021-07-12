<?php 
require_once __DIR__."/Conexion.php";
class UsuarioPrivilegio extends Conexion{
    private $bd = null;
    public function __construct(){
        parent::__construct();
        $this->bd = $this->conectar();
    }
    public function obtenerPrivilegios($username){
        try{
            $query = "";
            $consulta = $this->bd->prepare($query);
            $consulta->execute(["username"=>$username]);
            
        }catch(Exception $e){
            // TO DO manejar el error
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }
}
?>