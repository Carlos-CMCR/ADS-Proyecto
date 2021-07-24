<?php 
require_once __DIR__ ."/formEmitirProforma.php";
class controllerEmitirProforma {
    public function mostrarFormularioAddProductoYServicioAProforma(){
        include_once("../model/FactoryModels.php");
        $objTipoDeServicios = FactoryModels::getModel("tipodeservicio");
        $tiposServicio =  $objTipoDeServicios->listarServicios();
        $formulario = new formEmitirProforma();

        $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio);
    }

    public function buscarProducto($nombreProd){
        include_once("../model/FactoryModels.php");
        $objProducto = FactoryModels::getModel("producto");
        $objTipoDeServicios = FactoryModels::getModel("tipodeservicio");
        $tiposServicio =  $objTipoDeServicios->listarServicios();
        $datosProductos = $objProducto -> obtenerProductos($nombreProd);
        $formulario = new formEmitirProforma();
        $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio,[],$datosProductos,$nombreProd);
    }
}

?>