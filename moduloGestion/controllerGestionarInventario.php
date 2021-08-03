<?php
class controllerGestionarInventario{
    public function obtenerProductos(){
        include_once("../model/Producto.php");
        $objProducto = new Producto;
        $arrayProductos = $objProducto->ListaDeProductos();
        //var_dump($arrayProductos);
        include_once("formListaDeProductos.php");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
		$objListaProductos = new formListaDeProductos($_SESSION["informacion"]);
		$objListaProductos -> formListaDeProductosShow($arrayProductos);
    }
    public function buscarProducto($productos){
        include_once("../model/Producto.php");
        $objProducto = new Producto;
        $arrayProductos = $objProducto -> obtenerProductosB($productos);

        include_once("formListaDeProductos.php");
        session_start();
		$objListaProductos = new formListaDeProductos($_SESSION["informacion"]);
		$objListaProductos -> formListaDeProductosShow($arrayProductos,false,$productos);
    }
}

?>