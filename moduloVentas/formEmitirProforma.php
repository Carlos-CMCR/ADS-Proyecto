<?php 

require_once __DIR__ ."/../shared/footerSingleton.php";
require_once __DIR__ ."/../shared/headSingleton.php";
class formEmitirProforma {
    public function formEmitirProformaShow($informacion,$tiposServicio=[],$datosProducto = [],$datosProductos = [],$nomProd = ''){
        headSingleton::getHead("Formulario Proforma",$informacion,"..");
        
        echo "<main class='wrapper-actions'>";
        ?>
        <div>
            <form action="getEmitirProforma.php" method="post">
                <h3>Producto</h3>
                <input type="text" name="producto" value="<?php echo $nomProd?>">
                <button type="submit" class="" name="btnBuscarProducto">Buscar</button>
            </form>
            
        </div>
        
        <div class="wrapper-actions">
        <?php
        
        if(empty($datosProducto)){

        }else{?>
        
            <form class="lista-form" method="post" action="getComprobantePago.php">
                    <tr>
                        <th>Nombre Producto:</th>
                        <td><?php echo $datosProducto[0]["nombre"]?></td>            
                    </tr>
                    <tr>
                        <th>stock:</th>
                        <td><?php echo $datosProducto[0]["stock"]?></td>                
                    </tr>
                    <tr>
                        <th>Precio Unitario:</th>
                        <td><?php echo $datosProducto[0]["precioUnitario"]?></td>                
                    </tr>
                    <tr>
                        <th>Cantidad:</th>
                        
                        <input type="hidden" name="producto" value="<?php echo $nomProd?>">
                        <input type="hidden" name="idProducto" value="<?php echo $datosProducto[0]["id_producto"]?>">
                        <td><input type="number" name="cantidad" min="1" max="<?php echo $datosProducto[0]["stock"]?>" value="1"></td>                
                    </tr>
                    <div>
                        <button type="submit" name="btnAgregar">Agregar</button>
                    </div>  
        </form>
            
        <?php }
        ?>
        
        </div>
        
        <div id="container-servicios" style="width:100%;display:flex;justify-content: center;flex-direction: column;align-items: center;margin-bottom: 5rem;">
         <h2>Servicios</h2>
        <?php
                    foreach ($tiposServicio as $tipo) {
                        ?>
                        <div>
                            <label for="<?php echo $tipo['nombre']?>" ><?php echo $tipo['nombre']?></label>
                            <input type="checkbox" id="<?php echo $tipo['nombre']?>"
                            data-precioServicio = "<?php echo $tipo['precioDeServicio'] ?>"
                            data-idServicio = "<?php echo $tipo['id_tipo'] ?>">
                            <label for="<?php echo $tipo['precioDeServicio']?>" >S/. <?php echo $tipo['precioDeServicio']?></label>
                        </div>
                        <?php 
                    }
                ?>
            </div>
        
        <table class="lista-form">
        
        <?php
        
        if(empty($datosProductos)){
           
        }else{
            ?>
            <tr>
            <th>Código del Producto</th>
            <th>Nombre del Producto</th>
            <th>Acción</th>
        </tr>
            <?php
             
            foreach($datosProductos as $dato) {
                ?>
                <tr>
                <form action="getEmitirProforma.php" method= "post">
                    <input type="hidden" name="producto" value="<?php echo $nomProd?>">
                    <input type="hidden" name="idProducto" value="<?php echo $dato["id_producto"]?>">
                    <td align="center" ><?php echo $dato["codigo_producto"]?></td>
                    <td align="left" ><?php echo $dato["nombre"]?></td>
                    <td><button  type="submit" class="" name="btnSeleccionarProducto">Seleccionar</button></td>
                </form>
                
                </tr>
                <?php 
            }
        }?>
        </table>
        </div>
        <div class="lista-form">
        <form action='../moduloSeguridad/getUsuario.php'  method='post'>
            <button class="volver-form__button" name="btnInicio" type="submit" >Volver</button>
        <form>
            
        </div>


        <?php
        echo "</main>";
        ?>
        <?php 
        footerSingleton::getFooter("..");

    }
}

?>