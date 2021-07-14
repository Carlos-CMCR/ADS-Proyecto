<?php 
include_once("../shared/formulario.php");
class formFacturaGenerada extends formulario{
    public function __construct(){
        $this->path = "..";
        $this->encabezadoShow("Formulario Factura Generada");
    }

    public function formFacturaGeneradaShow($datosProforma=[]){
        ?>
        <main class='wrapper-actions'>
            <div style="width:100% ">
                <h2 align="center">Información de Factura </h2>
            </div>
            <div>
                <table class="lista-form">
                    <tr>
                        <th>Nombre</th>
                        <td><?php echo $datosProforma[0]['nom_client']." ".$datosProforma[0]['apellido_paterno']." ".$datosProforma[0]['apellido_materno']  ?></td>            
                    </tr>
                    <tr>
                        <th>DNI</th>
                        <td><?php echo $datosProforma[0]['dni'] ?></td>                
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td><?php echo $datosProforma[0]['celular'] ?></td>                
                    </tr>
                    <tr>
                        <th>RUC</th>
                        <td><input type="text" max="11" min="11"></td>               
                    </tr>    
                </table>
            </div>
            <div style="width:100%;">
                <table style="width:100%;">
                    <?php 
                    foreach ($datosProforma as $dato){
                        ?> 
                        <tr>
                        <td><button type="button" >X</button> </td>      
                        <td><p><?php echo $dato['nom_product'] ?></p></td>
                        <td><input type="number" value="<?php echo $dato['cantidad'] ?>" ></td>
                        <td><input type="string" value="<?php echo $dato['precioProduct']*$dato['cantidad'] ?>" disabled></td>
                        
                        </tr>
                        <?php 
                    }
                    ?>
                </table>
            </div>
        </main>
        <?php 
        $this->piePaginaShow();
    }
}
?>