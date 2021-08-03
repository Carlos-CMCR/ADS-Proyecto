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
    public function obtenerResponsable($username){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT CONCAT(UPPER(r.nombre_rol),' : ',u.apellido_paterno,' ',u.apellido_materno,' ',u.nombres) as responsable FROM usuarios as u 
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
    public function obtenerDatosUsuario($username){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT u.username, u.nombres, u.apellido_paterno, u.apellido_materno, es.nombre_estado, u.email, u.celular, r.nombre_rol  FROM usuarios as u
            INNER JOIN estadoentidad as es
            ON es.id_estadoEntidad = u.id_estadoEntidad
            INNER JOIN roles as r
            ON r.id_rol = u.id_rol
            WHERE u.username = :username;";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "username"=>$username
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true , "data" => $consulta->fetchAll()];
            }else{
                return ["existe"=>false ,"mensaje"=>"No existe el Usuario o está mal escrito " ];
            }
        }catch(Exception $e){
            // TO DO manejar el error
            return ["mensaje"=>$e->getMessage() ];
        }
            
    }
    public function obtenerRoles(){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT  * FROM roles; ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();
            return $consulta->fetchAll();            
            
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function obtenerEstado(){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT  * FROM estadoentidad ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();
            return $consulta->fetchAll();            
            
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function verificarEditarUsuario($username, $email, $celular){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT email, celular FROM usuarios WHERE NOT username= :username and (email = :email or celular= :celular)";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "username"=>$username,
                "email"=>$email,
                "celular"=>$celular
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true , "data" => $consulta->fetchAll()];
            }else{
                return ["existe"=>false ,"mensaje"=>"Se actualizó con exito " ];
            }
        }catch(Exception $e){
            // TO DO manejar el error
            return ["mensaje"=>$e->getMessage() ];
        }

    }
    public function editarUsuario($nombre, $apaterno, $amaterno, $username, $estado, $email,$celular,$rol){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "UPDATE usuarios SET nombres =:nombre,apellido_paterno =:apaterno,apellido_materno =:amaterno,id_rol =:rol,id_estadoentidad =:estado,celular =:celular,email =:email
            WHERE username= :username";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "nombre" => $nombre,
                "apaterno" => $apaterno,
                "amaterno" => $amaterno,
                "rol" => (int)$rol,
                "estado" => (int)$estado,
                "celular" => $celular,
                "email" => $email,
                "username" => $username,
            ]);
            return ["success"=>true,"mensaje"=>"Usuario editado con exito" ];
        }catch(Exception $e){
            return ["success"=>false,"mensaje"=>$e->getMessage() ];
        }
    }
}

?>