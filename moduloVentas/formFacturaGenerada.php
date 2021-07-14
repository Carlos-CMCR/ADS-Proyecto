<?php 
include_once("../shared/formulario.php");
class formFacturaGenerada extends formulario{
    public function __construct(){
        $this->path = "..";
        $this->encabezadoShow("Formulario Factura Generada");
    }

    public function formFacturaGeneradaShow($id_proforma){
        echo "<main class='wrapper-actions'>";
        
        ?>
        <div style="width:100% ">
            <h2 align="center">Información de Factura </h2>
        </div>
        <div>
        <table class="lista-form">
            <tr>
                <th>Nombre</th>
                <td>asdasd</td>            
            </tr>
            <tr>
                <th>DNI</th>
                <td>asdas</td>                
            </tr>
            <tr>
                <th>Teléfono</th>
                <td>adasd</td>                
            </tr>
            <tr>
                <th>RUC</th>
                <td><input></td>               
            </tr>
            
                        
        </table>
        </div>
               

        <?php 

        echo "</main>";
        $this->piePaginaShow(); 
    }
}
?>