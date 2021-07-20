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
            $query = "SELECT p.id_producto,p.codigo_producto, p.nombre, p.stock, p.precioUnitario  FROM productos p INNER JOIN marcas ma ON p.id_marca = ma.id_marca 
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

    public function listarProductosLista($idDeProductos = [],$idcliente){
        try {
            $query = "select p.id_producto,p.stock,p.codigo_producto,p.precioUnitario as precioProduct,p.nombre as nom_product,c.dni,c.nombres as nom_client,c.apellido_paterno,c.apellido_materno,c.celular from productos as p join clientes as c WHERE id_producto IN (";

            foreach ($idDeProductos as $key => $value) {
                $query.=(int)$key;
                $query.=",";
            }
            $query = substr($query, 0, -1).") and c.id_cliente = :id_cliente";
            $this->bd = $this->conectar();
            $consulta = $this->bd->prepare($query);
            $consulta->execute(["id_cliente"=>$idcliente]);
            return $consulta->fetchAll();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        finally {
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
    public  function updateStockOfProducts($productos){
        try {
            $this->bd = $this->conectar();
            $query = "UPDATE productos SET stock = stock - :cantidad WHERE id_producto = :id_producto";
            $consulta = $this->bd->prepare($query);
            foreach ($productos as $id => $cantidad) {
                $consulta->execute([
                    "cantidad" => $cantidad,
                    "id_producto" => $id
                ]);
            }
            
        }catch (Exception $ex) {
            return $ex->getMessage();
        }finally{
            // Conexion::closeConnection();
            $this->bd = null;
        }
    }

}
?>