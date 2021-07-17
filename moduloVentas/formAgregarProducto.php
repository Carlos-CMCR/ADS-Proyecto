<?php 
  include_once("../shared/formulario.php");
    class formAgregarProducto extends formulario{
      public function __construct($informacion){
          $this->path = "..";
          $this->encabezadoShow("Formulario Agregar Producto",$informacion);
      }

      public function formAgregarProductoShow($datosProducto = [],$id_proforma){
        echo "<main class='wrapper-actions'>";
        ?>
        <div>
            <form action="getComprobantePago.php" method="post">
                <h3>Producto</h3>
                <input type="text" name="producto" >
                <input type="hidden" name="idProforma" value="<?php echo $id_proforma;?>">
                <button type="submit" class="" name="btnBuscarProducto">Buscar</button>
            </form>
            
        </div>
        <div class="wrapper-actions">
        <table class="lista-form">
                    <tr>
                        <th>Nombre Producto:</th>
                        <td></td>            
                    </tr>
                    <tr>
                        <th>stock:</th>
                        <td></td>                
                    </tr>
                    <tr>
                        <th>Precio Unitario:</th>
                        <td></td>                
                    </tr>
                        
        </table>
        <form action="getComprobantePago.php" method="post">
            <input type="submit" class="" name="btnAgregar" value="Agregar"/>
            </form>
        </div>
        <div>
        <?php
        
        if(empty($datosProducto)){
           
        }else{
            foreach($datosProducto as $dato) {
                ?>
                <tr>
                <form action="getComprobantePago.php" method= "post">
                    <input type="hidden" name="idProducto" value="<?php echo $dato["id_producto"]?>">
                    <td align="center" ><?php echo $dato["codigo_producto"]?></td>
                    <td align="center" ><?php echo $dato["nombre"]?></td>
                    <td><button  type="submit" class="" name="btnSeleccionar">Seleccionar</button></td>
                </form>
                
                </tr>
                <?php 
            }
        }?>
        
        </div>



        <?php
        echo "</main>";
        $this->piePaginaShow(); 
      }
    }
?>