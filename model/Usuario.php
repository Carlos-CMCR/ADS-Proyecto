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
            $this->bd = $this->conectar();
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
    public function obtenerInformacionDelUsuario($username){
        try{
            $this->bd = $this->conectar();
            $query = "SELECT CONCAT(u.apellido_paterno,' ',u.apellido_materno,' ',u.nombres,' ( ',u.username,' ) ',' - ',' ( ',UPPER(r.nombre_rol),' )') as informacion FROM usuarios as u 
            INNER JOIN roles as r
             ON r.id_rol = u.id_rol
            WHERE u.username = :username";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "username"=>$username
            ]);
            return $consulta->fetch();
            
        }catch(Exception $e){
            // TO DO manejar el error
            return $e->getMessage();
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }

    public function cambiarPassword($username,$password){
        try{
            $this->bd = $this->conectar();
            $query = "UPDATE usuarios SET password = :password WHERE username = :username";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "username"=>$username,
                "password"=>$password
            ]);
            return ["success"=>true,"mensaje"=>"El password se ha cambiado con exito" ];
        }catch(Exception $e){
            return ["success"=>false,"mensaje"=>$e->getMessage() ];
        }
    }

    public function obtenerIdUsuario($username){
        try{
            $this->bd = $this->conectar();
            $query = "SELECT id_usuario FROM usuarios WHERE username = :username";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "username"=>$username
            ]);
            return $consulta->fetch();
        }catch(Exception $e){
            // TO DO manejar el error
            return $e->getMessage();
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }
}

?>