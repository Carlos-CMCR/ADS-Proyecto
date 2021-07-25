<?php 
require_once __DIR__ ."/formEmitirProforma.php";
class controllerEmitirProforma {
    public function mostrarFormularioAddProductoYServicioAProforma(){
        include_once("../model/FactoryModels.php");
        $objTipoDeServicios = FactoryModels::getModel("tipodeservicio");
        $tiposServicio =  $objTipoDeServicios->listarServicios();
        $formulario = new formEmitirProforma();
        if(count($_SESSION["lista_proforma"]["servicios"])){
            $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio,[],[],'',$_SESSION["lista_proforma"]["servicios"]);
        }else{
            $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio);
        }
    }

    public function buscarProducto($nombreProd){
        include_once("../model/FactoryModels.php");
        $objProducto = FactoryModels::getModel("producto");
        $objTipoDeServicios = FactoryModels::getModel("tipodeservicio");
        $tiposServicio =  $objTipoDeServicios->listarServicios();
        $datosProductos = $objProducto -> obtenerProductos($nombreProd);
        $formulario = new formEmitirProforma();
        if(count($_SESSION["lista_proforma"]["servicios"])){
            $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio,[],$datosProductos,$nombreProd,$_SESSION["lista_proforma"]["servicios"]);
        }else{
            $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio,[],$datosProductos,$nombreProd);
        }
    }
    public function seleccionarProducto($id_producto,$productos){
        include_once("../model/FactoryModels.php");
        $objProducto = FactoryModels::getModel("producto");
        $objTipoDeServicios = FactoryModels::getModel("tipodeservicio");
        $tiposServicio =  $objTipoDeServicios->listarServicios();
        $datosProducto = $objProducto -> obtenerProducto($id_producto);
        $datosProductos = $objProducto -> obtenerProductos($productos);
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
		$formulario = new formEmitirProforma();

        if(count($_SESSION["lista_proforma"]["servicios"])){
            $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio,$datosProducto,$datosProductos,$productos,$_SESSION["lista_proforma"]["servicios"]);
        }else{
            $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio,$datosProducto,$datosProductos,$productos);
        }
    }

    public function agregarProducto($idProducto,$productos,$cantidad){
        include_once("../model/FactoryModels.php");
        $objProducto = FactoryModels::getModel("producto");
        $objTipoDeServicios = FactoryModels::getModel("tipodeservicio");
        $tiposServicio =  $objTipoDeServicios->listarServicios();
        $datosProductos = $objProducto -> obtenerProductos($productos);
        $formulario = new formEmitirProforma();

        if(isset($_SESSION["lista_proforma"]["productos"][$idProducto])){
            $_SESSION["lista_proforma"]["productos"][$idProducto]+= $cantidad;
        }else{
            $_SESSION["lista_proforma"]["productos"][$idProducto]= $cantidad;
        }

        if(count($_SESSION["lista_proforma"]["servicios"])){
            $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio,[],$datosProductos,$productos,$_SESSION["lista_proforma"]["servicios"]);
        }else{
            $formulario->formEmitirProformaShow($_SESSION["informacion"],$tiposServicio,[],$datosProductos,$productos);
        }

    }
}

?>