<?php 
require_once __DIR__."/Conexion.php";
class Producto extends Conexion{
    private $bd = null;
    public function __construct(){
        parent::__construct();
        $this->bd = $this->conectar();
    }

    public function obtenerProductos($producto){
        try {
            $this->bd = $this->conectar();
            $query = "SELECT p.id_producto, p.codigo_producto, p.nombre  FROM productos p INNER JOIN marcas ma ON p.id_marca = ma.id_marca 
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

    public function obtenerProducto($id_producto){
        try {
            $this->bd = $this->conectar();
            $query = "SELECT p.id_producto, p.nombre, p.stock, p.precioUnitario  FROM productos p INNER JOIN marcas ma ON p.id_marca = ma.id_marca 
            INNER JOIN categorias ca ON p.id_categoria = ca.id_categoria WHERE p.id_observacion = 0 
            AND p.stock > 0 AND p.id_producto= :id;
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                'id' => $id_producto
            ]);
            return $consulta->fetchAll();          

        }catch(Exception $ex){
            return $ex->getMessage();
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }

    public function agregarProducto($id_producto, $id_proforma){
        try {
            $this->bd = $this->conectar();
            $query = "INSERT intop.id_producto, p.nombre, p.stock, p.precioUnitario  FROM productos p INNER JOIN marcas ma ON p.id_marca = ma.id_marca 
            INNER JOIN categorias ca ON p.id_categoria = ca.id_categoria WHERE p.id_observacion = 0 
            AND p.stock > 0 AND p.id_producto= :id;
            ";
            $consulta = $this->bd->prepare($query);
            $consulta->execute([
                'id_producto' => $id_producto,
                'id_proforma' => $id_proforma
            ]);
            return $consulta->fetchAll();          

        }catch(Exception $ex){
            return $ex->getMessage();
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }

    // REALLY ??
    public function obtenerPrecioUnitaciosProductos($idDeProductos = []){
        try {
            $query = "select precioUnitario,id_producto from productos WHERE id_producto IN (";

            foreach ($idDeProductos as $key => $value) {
                $query.=(int)$key;
                $query.=",";
            }
            $query = substr($query, 0, -1).")";
            $this->bd = $this->conectar();
            $consulta = $this->bd->prepare($query);
            $consulta->execute();
            return $consulta->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        finally {
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }

}
?>