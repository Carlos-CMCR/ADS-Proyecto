<?php 
require_once __DIR__."/ConexionSingleton.php";

class ComprobanteDePago{
    private $bd = null;
    public function insertarComprobante($id_cliente,$precioTotal,$id_usuario,$tipoComprobante,$ruc){
        try{
            date_default_timezone_set('America/Lima');
            $fechaYhora = date('Y-m-d H:i:s', time());
            $fechaemision = explode(" ", $fechaYhora)[0];
            $hora_emision = explode(" ", $fechaYhora)[1];

            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();

            if($tipoComprobante=="factura"){
                $query = "INSERT INTO 
                comprobantedepago
                (id_tipocomprobante,fechaemision,hora_emision,precioTotal,id_cliente,id_usuario,fechaYhora,id_estadoComprobante,ruc) 
                VALUES
                (0,:fechaemision,:hora_emision,:precioTotal,:id_cliente,:id_usuario,:fechaYhora,1,:ruc);";
                $consulta = $this->bd->prepare($query);
                $consulta->execute([
                    "fechaemision"=>$fechaemision,
                    "hora_emision"=>$hora_emision,
                    "precioTotal" => (double)$precioTotal,
                    "id_cliente" =>$id_cliente,
                    "id_usuario" => $id_usuario,
                    "fechaYhora"=>$fechaYhora,
                    "ruc"=>$ruc
                ]);
            }else{
                $query = "INSERT INTO 
                comprobantedepago
                (id_tipocomprobante,fechaemision,hora_emision,precioTotal,id_cliente,id_usuario,fechaYhora,id_estadoComprobante) 
                VALUES
                (1,:fechaemision,:hora_emision,:precioTotal,:id_cliente,:id_usuario,:fechaYhora,1);";
                $consulta = $this->bd->prepare($query);
                $consulta->execute([
                    "fechaemision"=>$fechaemision,
                    "hora_emision"=>$hora_emision,
                    "precioTotal" => (double)$precioTotal,
                    "id_cliente" =>$id_cliente,
                    "id_usuario" => $id_usuario,
                    "fechaYhora"=>$fechaYhora
                ]);
            }
            
            $id = $this->bd->lastInsertId();

            $codigoBoleta = substr('00000000' . $id, -8);
            $query = "UPDATE comprobantedepago SET 	numero_comprobante = :numero_comprobante where id_comprobante = :id_comprobante;";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "id_comprobante"=>$id,
                "numero_comprobante"=>$codigoBoleta,
            ]);

            return ["success"=>true,"id"=>$id]; 

        }catch(Exception $ex){
            return ["success"=>false,"message"=>$ex->getMessage()];
        }
    }

    public function insertDetalleComprobanteProductos($id_boleta,$productos = []){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "INSERT INTO detallecomprobanteproducto (id_producto,id_comprobante) VALUES ";
            foreach ($productos as $idp => $cantidad) {
                for ($i=0; $i < $cantidad ; $i++) { 
                    $query.="($idp,$id_boleta),";
                }
            }
            $query = substr_replace($query ,"",-1);
            $consulta = $this->bd->prepare($query);
            $consulta->execute();
            return ["success"=>true]; 
        }catch(Exception $ex){
            return ["success"=>false,"message"=>$ex->getMessage()];
        }
    }
    public function insertDetalleComprobanteServicios($id_boleta,$servicios){
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "INSERT INTO detallecomprobanteservicio (id_servicio,id_comprobante) VALUES ";
            for ($i=0; $i < count($servicios) ; $i++) { 
                $query= $query . "( $servicios[$i], $id_boleta),";
            }
            $query = substr_replace($query ,"",-1);
            $consulta = $this->bd->prepare($query);
            $consulta->execute();
            return ["success"=>true]; 
        }catch(Exception $ex){
            return ["success"=>false,"message"=>$ex->getMessage()];
        }
    }

    public function obtenerProductosDeComprobante($id){
        try {
            # code...
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT count(pr.id_producto) as cantidad,cb.id_comprobante,cb.fechaemision,cb.hora_emision,cb.ruc,cb.precioTotal,pr.nombre as nombre_producto,pr.codigo_producto,cb.numero_comprobante,c.dni,c.nombres as nombre_cliente,c.apellido_paterno,c.apellido_materno,c.email,c.celular, pr.precioUnitario as precioProduct FROM comprobantedepago cb 
            INNER JOIN clientes c
            ON c.id_cliente = cb.id_cliente
            INNER JOIN detallecomprobanteproducto dcp
                ON dcp.id_comprobante = cb.id_comprobante
            INNER JOIN productos pr
                ON pr.id_producto = dcp.id_producto
            WHERE  cb.id_comprobante = :id_comprobante
            GROUP BY pr.id_producto;";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                'id_comprobante' => (int)$id
            ]);
            if($consulta->rowCount()){
                return $consulta->fetchAll();          
            }
            return [];
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function obtenerServiciosDeComprobante($id){
        try {
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT dcs.id_servicio,ts.nombre, ts.precioDeServicio,cdp.precioTotal FROM comprobantedepago as cdp
            INNER JOIN detallecomprobanteservicio as dcs
                on dcs.id_comprobante = cdp.id_comprobante
            INNER JOIN tipodeservicios as ts
            ON ts.id_tipo = dcs.id_servicio
            WHERE cdp.id_comprobante = :id_comprobante";

            $consulta = $this->bd->prepare($query);

            $consulta->execute([
                'id_comprobante' => (int)$id
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true, "data"=> $consulta->fetchAll()];
            }else{
                return ["existe"=>false];
            }        
        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function listarComprobantes(){
        try {
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT cp.numero_comprobante, tp.nombre,c.nombres,c.apellido_paterno,c.apellido_materno,ec.nombre_estado,cp.fechaemision,cp.id_comprobante
            FROM comprobantedepago cp 
            INNER JOIN tipocomprobante tp
            ON cp.id_tipoComprobante = tp.id_tipocomprobante
            INNER JOIN estadocomprobante ec
            ON cp.id_estadoComprobante = ec.id_estadoComprobante
            INNER JOIN clientes c
            ON cp.id_cliente = c.id_cliente
            WHERE TIMESTAMPDIFF(HOUR,cp.fechaYHora,CURRENT_TIMESTAMP) <= 12 AND cp.id_estadoComprobante = 1
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();

            return $consulta->fetchAll();

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }
    public function listarComprobantesFecha($fecha_seleccionada){
        try {
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $query = "SELECT cp.numero_comprobante, tp.nombre,c.nombres,c.apellido_paterno,c.apellido_materno,ec.nombre_estado,cp.fechaemision,cp.id_comprobante
            FROM comprobantedepago cp 
            INNER JOIN tipocomprobante tp
            ON cp.id_tipoComprobante = tp.Id_tipocomprobante
            INNER JOIN estadocomprobante ec
            ON cp.id_estadoComprobante = ec.id_estadoComprobante
            INNER JOIN clientes c
            ON cp.id_cliente = c.Id_cliente
            WHERE  cp.fechaemision = :fecha_seleccionada and cp.id_estadoComprobante = 1";
            
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                'fecha_seleccionada' => $fecha_seleccionada
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true, "data"=> $consulta->fetchAll()];
            }else{
                return ["existe"=>false,"mensaje"=>"No se encontrado ninguna comprobante habilitada" ];
            }

            

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }
}
?>