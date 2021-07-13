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
            $query = "SELECT p.codigo_proforma, p.fecha_emision, c.nombres, c.apellido_paterno, c.apellido_materno  FROM proformas p 
             INNER JOIN clientes c
             ON c.id_cliente = p.id_cliente
            WHERE  TIMESTAMPDIFF(HOUR,P.fechaYHora,CURRENT_TIMESTAMP) <= 12 and p.id_estadoProforma = 1";
            $consulta = $this->bd->prepare($query);
            $consulta->execute();

            return $consulta->fetchAll();

        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function listarProformasFecha($fecha_seleccionada){
        try {
            $query = "SELECT p.codigo_proforma, p.fecha_emision, c.nombres, c.apellido_paterno, c.apellido_materno FROM proformas p 
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
        }
    }
}

?>