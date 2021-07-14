<?php 
include_once("../shared/formulario.php");
class formTipoComprobantePago extends formulario{
    public function __construct(){
        $this->path = "..";
        $this->encabezadoShow("Formulario Tipo de Comprobante de Pago");
    }

    public function formTipoComprobantePagoShow(){
        echo "llegue";
    }
}
?>