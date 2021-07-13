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

    }
    
?>