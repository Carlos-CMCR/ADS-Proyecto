<?php 
require_once __DIR__."/Conexion.php";
class Incidencia extends Conexion{
    private $bd = null;
    public function __construct(){
        parent::__construct();
        $this->bd = $this->conectar();
    }

    public function insertarIncidencia($fecha,$hora,$asunto,$descripcion,$id_usuario){
        try{
            $this->bd = $this->conectar();
            $query = "INSERT into incidencias ( hora_notificada,fecha_notificada,asunto, descripcion,id_estadoincidencia,id_usuario)
            VALUES ( :hora_notificada, :fecha_notificada, :asunto, :descripcion, 1, :id_usuario);";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                "hora_notificada" => $hora,
                "fecha_notificada" => $fecha,
                "asunto" => $asunto,
                "descripcion" => $descripcion,
                "id_usuario" => $id_usuario
            ]);
            return ["success"=>true,"mensaje"=>"Incidencia registrada con exito" ];
        }catch(Exception $e){
            return ["success"=>false,"mensaje"=>$e->getMessage() ];
        }
    }

    

}
?>