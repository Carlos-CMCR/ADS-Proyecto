<?php 
// require __DIR__ . "/BD.php";
// var_dump(__DIR__);
include_once("conecta.php");
class Usuario extends conecta{
    private $connection = null;
    public function __construct(){
        $this->connection = $this->connectar();
    }
    public function verificarUsuario($username,$password){
        $query = "SELECT * FROM usuarios WHERE username = :username AND password = :password";
        try{
            $consulta = $this->connection->query($query);
            $consulta->execute([
                "username" => $username,
                "password" => $password
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true];
            }else{
                return ["existe"=>false,"mensaje"=>"El usuario/password incorrecto o no esta habilitado" ];
            }
        }catch(Exception $e){
            // TO DO manejar el error
        }finally{
            // Conexion::closeConnection();
            $this->connection = null;
        }

    }
}

?>