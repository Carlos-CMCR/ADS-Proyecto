<?php 
class controllerEmitirComprobantePago{
    public function obtenerProformas(){
        include_once("../model/Proforma.php");
        $objProforma = new Proforma;
        $arrayProformas = $objProforma->listarProformas();
        //var_dump($arrayProformas);
        include_once("formListaProformas.php");
		$objListaProformas = new formListaProformas();
		$objListaProformas -> formListaProformasShow($arrayProformas);
    }

    public function obtenerProformasFecha($fecha_seleccionada){
        include_once("../model/Proforma.php");
        $objProforma = new Proforma;
        $resultado = $objProforma->listarProformasFecha($fecha_seleccionada);
        if($resultado["existe"]){
            include_once("formListaProformas.php");
            $objListaProformas = new formListaProformas();
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
		$objTipoComprobantePago = new formTipoComprobantePago();
		$objTipoComprobantePago -> formTipoComprobantePagoShow($id_proforma);
    }

    public function obtenerProforma($id_proforma){
        include_once("../model/Proforma.php");
        $objProforma = new Proforma;
        $datos = $objProforma->proformaSeleccionada($id_proforma);
        include_once("formFacturaGenerada.php");
        $objFacturaGenerada = new formFacturaGenerada();
        $objFacturaGenerada -> formFacturaGeneradaShow($id_proforma);
    }



    }
    
?>