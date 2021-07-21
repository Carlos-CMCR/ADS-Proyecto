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
}
?>