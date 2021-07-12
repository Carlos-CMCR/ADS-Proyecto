<?php 
require_once __DIR__."/Conexion.php";
class Usuario extends Conexion{
    private $bd = null;
    public function __construct(){
        parent::__construct();
        $this->bd = $this->conectar();
    }
    public function verificarUsuario($username,$password){
        
        try{
            $query = "SELECT * FROM usuarios as u WHERE u.username =:username AND u.password = :password";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "username"=>$username,
                "password"=>$password
            ]);
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