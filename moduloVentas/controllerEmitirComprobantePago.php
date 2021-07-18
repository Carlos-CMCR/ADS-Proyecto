<?php 
class controllerEmitirComprobantePago{
    public function obtenerProformas(){
        include_once("../model/Proforma.php");
        $objProforma = new Proforma;
        $arrayProformas = $objProforma->listarProformas();
        //var_dump($arrayProformas);
        include_once("formListaProformas.php");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
		$objListaProformas = new formListaProformas($_SESSION["informacion"]);
		$objListaProformas -> formListaProformasShow($arrayProformas);
    }

    public function obtenerProformasFecha($fecha_seleccionada){
        include_once("../model/Proforma.php");
        $objProforma = new Proforma;
        $resultado = $objProforma->listarProformasFecha($fecha_seleccionada);
        if($resultado["existe"]){
            include_once("formListaProformas.php");
            session_start();
            $objListaProformas = new formListaProformas($_SESSION["informacion"]);
            $objListaProformas -> formListaProformasShow($resultado["data"]);
        }else{
            include_once("../shared/formMensajeSistema.php");
				$nuevoMensaje = new formMensajeSistema;
				$nuevoMensaje -> formMensajeSistemaShow(
                $resultado["mensaje"],
                    "<form action='getComprobantePago.php' class='form-message__link' method='post' style='padding:0;'>
                        <input name='btnEmitirComprobante'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>");
        }
        //var_dump($arrayProformas);
        
    }

    public function tipoComprobantePago($id_proforma){
        include_once("formTipoComprobantePago.php");
        session_start();
		$objTipoComprobantePago = new formTipoComprobantePago($_SESSION["informacion"]);
		$objTipoComprobantePago -> formTipoComprobantePagoShow($id_proforma);
    }

    public function obtenerProforma($id_proforma, $button){
        include_once("../model/Proforma.php");
        include_once("../model/TipoDeServicio.php");
        $objProforma = new Proforma;
        $objTipoDeServicios = new TipoDeServicio;

        $datosProformaProductos = $objProforma->obtenerProductosDeproformaSeleccionada($id_proforma);
        $datosProformaServicios = $objProforma->obtenerServiciosDeproformaSeleccionada($id_proforma);
        $tiposServicio =  $objTipoDeServicios->listarServicios();
        session_start();
        $_SESSION["lista"] = ["productos"=>[],"servicios"=>[]];
        $productos = [];
        $servicios = [];

        foreach ($datosProformaProductos as $dato){
            $productos[$dato["id_producto"]] = $dato["cantidad"];
        }
        $datosProforma = ["datosProformaProductos"=>$datosProformaProductos,"datosProformaServicios"=>[]];

        if($datosProformaServicios["existe"]){
            foreach ($datosProformaServicios["data"] as $dato){
                array_push($servicios,$dato["id_tiposervicio"]);
            }
            $datosProforma["datosProformaServicios"] = $datosProformaServicios["data"];
        }
        $_SESSION["lista"]["productos"] = $productos;
        $_SESSION["lista"]["servicios"] = $servicios;

        // true si es factura
        if($button == true){
            include_once("formFacturaGenerada.php");
            $objFacturaGenerada = new formFacturaGenerada($_SESSION["informacion"]);
            $objFacturaGenerada -> formFacturaGeneradaShow($datosProforma,$tiposServicio);
        }else{
            // false si es boleta
            include_once("formBoletaGenerada.php");
            $objBoletaGenerada = new formBoletaGenerada($_SESSION["informacion"]);
            $objBoletaGenerada -> formBoletaGeneradaShow($id_proforma,$datosProforma,$tiposServicio);
        }
        
    }

    public function agregarProductos($id_proforma){
        include_once("../model/Producto.php");
        include_once("formAgregarProducto.php");
        session_start();
		$objAgregarProducto = new formAgregarProducto($_SESSION["informacion"]);
		$objAgregarProducto -> formAgregarProductoShow([],[], $id_proforma);
    }

    public function buscarProducto($productos, $id_proforma){
        include_once("../model/Producto.php");
        $objProducto = new Producto;
        $datosProductos = $objProducto -> obtenerProductos($productos);

        include_once("formAgregarProducto.php");
        session_start();
		$objAgregarProducto = new formAgregarProducto($_SESSION["informacion"]);
		$objAgregarProducto -> formAgregarProductoShow([],$datosProductos , $id_proforma,$productos);
    }

    public function seleccionarProducto($id_producto, $id_proforma,$productos){
        include_once("../model/Producto.php");
        $objProducto = new Producto;
        $datosProducto = $objProducto -> obtenerProducto($id_producto);
        $datosProductos = $objProducto -> obtenerProductos($productos);
        include_once("formAgregarProducto.php");
        session_start();
		$objAgregarProducto = new formAgregarProducto($_SESSION["informacion"]);
		$objAgregarProducto -> formAgregarProductoShow($datosProducto,$datosProductos, $id_proforma,$productos);
    }

    public function agregarProducto($id_producto, $id_proforma,$productos){
        $objProducto = new Producto;
        $objProducto -> agregarProducto($id_producto, $id_proforma);
        $datosProducto = $objProducto -> obtenerProducto($id_producto, $id_proforma);
        $datosProductos = $objProducto -> obtenerProductos($productos);
        include_once("formAgregarProducto.php");
        session_start();
		$objAgregarProducto = new formAgregarProducto($_SESSION["informacion"]);
		$objAgregarProducto -> formAgregarProductoShow($datosProducto,$datosProductos, $id_proforma,$productos);
    }

    public function obtenerPrecioUnitaciosProductos($idDeProductos){
        include_once("../model/Producto.php");
        $objProducto = new Producto;
        $datosPreciosUnitarios = $objProducto ->obtenerPrecioUnitaciosProductos($idDeProductos);
        return $datosPreciosUnitarios;
    }


}
    
?>