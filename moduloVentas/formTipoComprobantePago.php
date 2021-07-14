<?php 
include_once("../shared/formulario.php");
class formTipoComprobantePago extends formulario{
    public function __construct($informacion){
        $this->path = "..";
        $this->encabezadoShow("Formulario Tipo de Comprobante de Pago",$informacion);
    }

    public function formTipoComprobantePagoShow($id_proforma){
        echo "<main class='wrapper-actions'>";
        
        ?>
        
        <form action="getComprobantePago.php" method="post">
            <input type="hidden" value="<?php echo $id_proforma;?>" name="idProforma">
            <input  type="submit" name="btnFactura"  value="Factura">
            <input type="submit" name="btnBoleta"  value="Boleta">
            <input  type="submit" name="btnEmitirComprobante" value="Volver" >
        </form>

        <?php 

        echo "</main>";
        $this->piePaginaShow(); 
    }
}
?>