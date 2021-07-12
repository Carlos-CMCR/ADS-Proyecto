<?php 
require_once __DIR__."/Conexion.php";
class Usuario extends Conexion{
    private $connection = null;
    public function __construct(){
        parent::__construct();
        $this->bd = $this->conectar();
    }
    public function verificarUsuario($username,$password){
        
        try{
            $query = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
            $consulta = $this->bd->query($query);
            $consulta->execute();
            if($consulta->rowCount()){ 
                return ["existe"=>true];
            }else{
                return ["existe"=>false,"mensaje"=>"El usuario/password incorrecto o no esta habilitado" ];
            }
        }catch(Exception $e){
            // TO DO manejar el error
            return ["existe"=>false,"mensaje"=>$e->getMessage() ];
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }

    }
}

?>