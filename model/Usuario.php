<?php 
require_once __DIR__."/ConexionSingleton.php";
class Usuario{
    private $bd = null;
    public function verificarUsuario($username,$password){
        
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
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
        }

    }
    public function obtenerInformacionDelUsuario($username){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
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
        }
    }

    public function cambiarPassword($username,$password){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
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
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT id_usuario FROM usuarios WHERE username = :username";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "username"=>$username
            ]);
            return $consulta->fetch();
        }catch(Exception $e){
            // TO DO manejar el error
            return $e->getMessage();
        }
    }
}

?>