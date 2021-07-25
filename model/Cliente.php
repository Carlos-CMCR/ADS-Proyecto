<?php 
require_once __DIR__."/ConexionSingleton.php";
class Cliente{
    private $bd = null;
    public function buscarClientePorDNI($dni){
        $sql = "SELECT * FROM clientes WHERE dni = :dni";
        try{
            $this->bd = ConexionSingleton::getInstanceDB()->getConnection();
            $consulta = $this->bd->prepare($sql);
            $consulta->execute([
                'dni' => $dni
            ]);
            if($consulta->rowCount()){ 
                return ["existe"=>true,"data"=>$consulta->fetch()];
            }else{
                return ["existe"=>false,"mensaje"=>"El cliente con el dni $dni no existe asdasdas" ];
            }
        }catch(Exception $ex){
            return ["existe"=>false,"mensaje"=>$ex->getMessage() ];
        }

    }
}


?>