<?php
class controllerGestionarInventario{
    public function obtenerProductos(){
        include_once("../model/FactoryModels.php");
        $objProducto = FactoryModels::getModel("producto");
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
        include_once("../model/FactoryModels.php");
        $objProducto = FactoryModels::getModel("producto");
        $arrayProductos = $objProducto -> obtenerProductosB($productos);

        include_once("formListaDeProductos.php");
        session_start();
		$objListaProductos = new formListaDeProductos($_SESSION["informacion"]);
		$objListaProductos -> formListaDeProductosShow($arrayProductos,false,$productos);
    }
    //Paranuevoproducto
    public function obtenerOpcionProducto( ) {
        include_once("../model/FactoryModels.php");
        $objObservaciones = FactoryModels::getModel("observacion");
        $objCategorias = FactoryModels::getModel("categoria"); 
        $objMarcas = FactoryModels::getModel("marca"); 
        $objEstados = FactoryModels::getModel("estado_entidad"); 

        $observaciones = $objObservaciones->listarObservaciones();
        $categorias = $objCategorias->listarCategorias();
        $marcas = $objMarcas->listarMarcas();
        $estados = $objEstados->listarEstadoEntidad();
       
        include_once("formNuevoProducto.php");
        session_start();
        $form = new formNuevoProducto($_SESSION["informacion"]);
        $form->formNuevoProductoShow($observaciones,$categorias,$marcas,$estados);
    }
}

?>