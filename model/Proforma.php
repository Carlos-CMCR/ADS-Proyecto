<?php 
require_once __DIR__."/Conexion.php";
class Proforma extends Conexion{
    private $bd = null;
    public function __construct(){
        parent::__construct();
        $this->bd = $this->conectar();
    }

    public function listarProformas(){
        try {
            $this->bd = $this->conectar();
            $query = "SELECT p.id_proforma, p.codigo_proforma, p.fecha_emision, c.nombres, c.apellido_paterno, c.apellido_materno  FROM proformas p 
             INNER JOIN clientes c
             ON c.id_cliente = p.id_cliente
            WHERE  TIMESTAMPDIFF(HOUR,P.fechaYHora,CURRENT_TIMESTAMP) <= 12 and p.id_estadoProforma = 1";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();

            return $consulta->fetchAll();

        }catch(Exception $ex){
            return $ex->getMessage();
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }

    public function listarProformasFecha($fecha_seleccionada){
        try {
            $this->bd = $this->conectar();
            $query = "SELECT p.id_proforma, p.codigo_proforma, p.fecha_emision, c.nombres, c.apellido_paterno, c.apellido_materno FROM proformas p 
            INNER JOIN clientes c
             ON c.id_cliente = p.id_cliente
            WHERE  p.fecha_emision = :fecha_seleccionada and p.id_EstadoProforma = 1
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                'fecha_seleccionada' => $fecha_seleccionada
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true, "data"=> $consulta->fetchAll()];
            }else{
                return ["existe"=>false,"mensaje"=>"No se encontrado ninguna proforma habilitada" ];
            }

            

        }catch(Exception $ex){
            return $ex->getMessage();
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }

    public function obtenerProductosDeproformaSeleccionada($id_proforma){
        try {
            $this->bd = $this->conectar();
            $query = "SELECT count(pr.id_producto) as cantidad,p.id_proforma, c.nombres as nom_client, c.apellido_paterno, c.apellido_materno, c.dni, c.celular,dp.id_producto, dp.id_detalleProforma
            ,pr.nombre as nom_product, pr.precioUnitario as precioProduct FROM proformas p 
                INNER JOIN clientes c
                ON c.id_cliente = p.id_cliente
                INNER JOIN detalleProformas dp
                    ON dp.id_proforma = p.id_proforma
                INNER JOIN productos pr
                    ON pr.id_producto = dp.id_producto
                WHERE  p.id_proforma = :id_proforma and p.id_EstadoProforma = 1
                GROUP BY pr.id_producto;
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                'id_proforma' => (int)$id_proforma
            ]);
            return $consulta->fetchAll();          

        }catch(Exception $ex){
            return $ex->getMessage();
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }

    public function obtenerServiciosDeproformaSeleccionada($id_proforma){
        try {
            $this->bd = $this->conectar();
            $query = "SELECT dps.id_tiposervicio,ts.nombre FROM proformas as p
            INNER JOIN detalleproformaservicio as dps
                on dps.id_proforma = p.id_proforma
            INNER JOIN tipodeservicios as ts
            ON ts.id_tipo = dps.id_tiposervicio
            WHERE p.id_proforma = :id_proforma";

            $consulta = $this->bd->prepare($query);

            $consulta->execute([
                'id_proforma' => (int)$id_proforma
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true, "data"=> $consulta->fetchAll()];
            }else{
                return ["existe"=>false];
            }        
        }catch(Exception $ex){
            return $ex->getMessage();
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }
    
}

?>

