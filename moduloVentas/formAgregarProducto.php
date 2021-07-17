<?php 
  include_once("../shared/formulario.php");
    class formAgregarProducto extends formulario{
      public function __construct($informacion){
          $this->path = "..";
          $this->encabezadoShow("Formulario Agregar Producto",$informacion);
      }

      public function formAgregarProductoShow($id_proforma){
        echo "<main class='wrapper-actions'>";
        ?>
        <div>
            <form action="getComprobantePago.php" method="post">
                <h3>Producto</h3>
                <input type="text" name="producto">
                <button type="submit" class="buscar-form__button" name="btnBuscar">Buscar</button>
            </form>
            <h3>Producto</h3>
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
            <input type="submit" class="buscar-form__button" name="btnAgregar" value="Agregar"/>
            </form>
        </div>
        <div>

        </div>



        <?php
        echo "</main>";
        $this->piePaginaShow(); 
      }
    }
?>