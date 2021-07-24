<?php 
require_once __DIR__ ."/formEmitirProforma.php";
class controllerEmitirProforma {
    public function mostrarFormularioAddProductoYServicioAProforma(){
        $formulario = new formEmitirProforma();
        $formulario->formEmitirProformaShow($_SESSION["informacion"]);
    }

    public function buscarProducto($nombreProd){
        include_once("../model/FactoryModels.php");
        $objProducto = FactoryModels::getModel("producto");
        $datosProductos = $objProducto -> obtenerProductos($nombreProd);
        $formulario = new formEmitirProforma();
        $formulario->formEmitirProformaShow($_SESSION["informacion"],[],$datosProductos,$nombreProd);
    }
}

?>