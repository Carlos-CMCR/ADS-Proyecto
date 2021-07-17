<?php 
require_once __DIR__."/Conexion.php";
class Producto extends Conexion{
    private $bd = null;
    public function __construct(){
        parent::__construct();
        $this->bd = $this->conectar();
    }

    public function obtenerProducto($producto){
        try {
            $this->bd = $this->conectar();
            $query = "SELECT pd.id_producto, p.codigo_producto, p.nombre  FROM productos p INNER JOIN marcas ma ON p.id_marca = ma.id_marca 
            INNER JOIN categorias ca ON p.id_categoria = ca.id_categoria WHERE p.id_observacion = 0 
            AND p.stock > 0 AND p.nombre LIKE '$producto%' OR ma.marca_nombre LIKE '$producto%' OR ca.nombre_categoria 
            LIKE '$producto%' OR p.codigo_producto LIKE '$producto%';
            ";
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

}
?>