<?php 
require_once __DIR__."/ConexionSingleton.php";
class Servicio{
    private $bd = null;
    public function listarServicio(){
        try {
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT s.id_servicio,tds.nombre, s.fecha_inicio_servicio as fecha,s.direccion,
            cp.numero_comprobante, es.nombreServicio as estado,   s.descripcion , 
           s.hora_inicio_servicio as hora, c.nombres as cliente, c.dni
           FROM servicios as s 
           INNER JOIN tipodeservicios as tds 
           ON s.id_tipo = tds.id_tipo 
           INNER JOIN clientes as c 
           ON s.id_cliente = c.id_cliente
           INNER JOIN estadoservicio as es 
           ON es.id_estadoservicio = s.id_estadoservicio
           INNER JOIN detallecomprobanteservicio as ds
           ON ds.id_detallecomprobanteservicio = s.id_detallecomprobanteservicio
           INNER JOIN comprobantedepago as cp
           ON cp.id_comprobante = ds.id_comprobante;
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();

            return $consulta->fetchAll();

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function listarServiciosDNI($dni) {
        try {
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT s.id_servicio, tds.nombre, s.fecha_inicio_servicio as fecha,s.direccion,
            cp.numero_comprobante, es.nombreServicio as estado,   s.descripcion , 
           s.hora_inicio_servicio as hora, c.nombres as cliente, c.dni
           FROM servicios as s 
           INNER JOIN tipodeservicios as tds 
           ON s.id_tipo = tds.id_tipo 
           INNER JOIN clientes as c 
           ON s.id_cliente = c.id_cliente
           INNER JOIN estadoservicio as es 
           ON es.id_estadoservicio = s.id_estadoservicio
           INNER JOIN detallecomprobanteservicio as ds
           ON ds.id_detallecomprobanteservicio = s.id_detallecomprobanteservicio
           INNER JOIN comprobantedepago as cp
           ON cp.id_comprobante = ds.id_comprobante
           WHERE c.dni = :dni;
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                'dni' => $dni
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true, "data"=> $consulta->fetchAll()];
            }else{
                return ["existe"=>false,"mensaje"=>"No se encontrado ningun servicio agendado con el dni ingresado" ];
            }

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function obtenerServicio($id_servicio) {
        try {
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT s.id_servicio, tds.nombre, s.fecha_inicio_servicio as fecha,
            s.direccion,
            cp.numero_comprobante, es.nombreServicio as estado,   s.descripcion , 
           s.hora_inicio_servicio as hora, c.nombres as cliente, c.dni
           FROM servicios as s 
           INNER JOIN tipodeservicios as tds 
           ON s.id_tipo = tds.id_tipo 
           INNER JOIN clientes as c 
           ON s.id_cliente = c.id_cliente
           INNER JOIN estadoservicio as es 
           ON es.id_estadoservicio = s.id_estadoservicio
           INNER JOIN detallecomprobanteservicio as ds
           ON ds.id_detallecomprobanteservicio = s.id_detallecomprobanteservicio
           INNER JOIN comprobantedepago as cp
           ON cp.id_comprobante = ds.id_comprobante
           WHERE s.id_servicio = $id_servicio;
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();
            return $consulta->fetchAll();
            
            

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function obtenerEstadoServicio(){
        try {
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT * FROM estadoservicio;
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();
            return $consulta->fetchAll();
            
            
            

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function updateServicio($id_servicio,$fecha,$hora,$direccion,$estado,$descripcion){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "UPDATE servicios SET fecha_inicio_servicio = :fecha,
            hora_inicio_servicio = :hora,
            descripcion = :descripcion,
            id_estadoservicio = :estado,
            direccion = :direccion
            
             where id_servicio = :id_servicio;";
            $consulta = $this->bd->prepare($query);

            $consulta->execute([
                'fecha' => $fecha,
                'hora' => $hora,
                'direccion' => $direccion,
                'estado' => $estado,
                'descripcion' => $descripcion,
                'id_servicio' => $id_servicio
            ]);
            return ["success"=>true];
        }catch(Exception $ex){
            return ["success"=>false,"message"=>$ex->getMessage()];
        }
    }
    

    public function obtenerServicioporHora($hora, $fecha){
        try {
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT s.id_servicio  FROM servicios as s WHERE s.hora_inicio_servicio = :hora AND s.fecha_inicio_servicio = :fecha ;
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                'hora' => $hora,
                'fecha' => $fecha
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true, "data"=> $consulta->fetchAll()];
            }else{
                return ["existe"=>false,"mensaje"=>"No se encontrado ningun servicio habilitado" ];
            }
            
            
            

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function agregarServicio($id_comprobanteservicio,$id_cliente ,$fecha,$hora,$direccion,$estado,$descripcion){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "INSERT INTO 
                servicios
                (fecha_inicio_servicio,hora_inicio_servicio,id_cliente,descripcion,id_estadoservicio,direccion,id_detallecomprobanteservicio) 
                VALUES
                ( :fecha, :hora, :id_cliente, :descripcion, :estado, :direccion, :id_comprobanteservicio);";
                $consulta = $this->bd->prepare($query);
                $consulta->execute([
                    "fecha"=>$fecha,
                    "hora"=>$hora,
                    "id_cliente" => $id_cliente,
                    "estado" =>$estado,
                    "direccion" => $direccion,
                    "descripcion" => $descripcion,
                    "id_comprobanteservicio"=>$id_comprobanteservicio,
                    ]);
                        
            $id = $this->bd->lastInsertId();

            return ["success"=>true,"id"=>$id]; 

        }catch(Exception $ex){
            return ["success"=>false,"message"=>$ex->getMessage()];
        }
    }

}    
?>