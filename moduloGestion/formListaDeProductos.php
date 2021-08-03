<?php 
include_once("../shared/formulario.php");
class formListaDeProductos extends formulario{
    public function __construct($informacion){
        $this->path = "..";
        $this->encabezadoShow("Formulario Lista de Productos",$informacion);
    }

    public function formListaDeProductosShow($listaDeProductos = [],$clickObservaciones = false,$campobuscar = ''){
        include_once("getGestionarInventario.php");
        echo "<main class='wrapper-actions'>";
        
        ?>

        <h1>Lista de Productos</h1>
        <div class="lista-form">
            <form action="getGestionarInventario.php" method="post" >
            <input type="text" name="producto" value="<?php echo $campobuscar?>">
            <button type="submit" class="buscar-form__button" name="btnBuscar">Buscar</button>
            </form>
            
        </div>

        <table class="lista-form">
            <tr>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Stock</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Marca</th>
                <th>Descripcion</th>
                <th>Observacion</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>
            
            <?php
            
            foreach ($listaDeProductos as $productos) {
                ?>
                <tr>
                <form action="getGestionarInventario.php" method= "post">
                    <input type="hidden" name="idProducto" value="<?php echo $productos["id_producto"];?>">
                   
                    <td align="center" ><?php echo $productos["codigo_producto"]?></td>
                    <td align="center" ><?php echo $productos["nombre"]?></td>
                    <td align="center"><?php echo $productos["stock"]?></td>
                    <td align="center"><?php echo $productos["precioUnitario"]?></td>
                    <td align="center"><?php echo $productos["nombre_categoria"]?></td>
                    <td align="center"><?php echo $productos["marca_nombre"]?></td>
                    <td style="padding:10px"><?php echo $productos["descripcion"]?></td>
                    <td align="center"><?php echo $productos["nombre_observacion"]?></td>
                    <td align="center"><?php echo $productos["nombre_estado"]?></td>

                    <td><button  type="submit" class="lista-form__button" name="btnModificar">Modificar</button></td>
                </form>
                
                </tr>
       
                <?php 
            }?>
             </table>
        <table class="lista-form">
        <tr>
        <td align="center">
          
            
        <form action='../moduloSeguridad/getUsuario.php'  method='post'>
            <button class="" name="btnInicio" type="submit" >Ir al inicio</button>
        </form> 
        
        </td>
        <td align="center">
        
        <form action='getGestionarInventario.php'  method='post'>

            <button  name="btnNuevo" type="submit" class="verde-form__button">Nuevo</button>
            <button type="submit" name="btnObservaciones" class="verde-form__button">Observaciones</button>
            <?php 
             if($clickObservaciones){
                 ?>
                    <input type="hidden" name="observaciones">
                    <?php 
             }else{
                 ?>
                 <input type="hidden" name="campobuscar" value="<?php echo $campobuscar?>">
                 <?php
             }
            ?>       
            <button type="submit" class="verde-form__button" >Imprimir Reporte Inventario</button>
        </form>

        
        </td>
        
        </tr>
        </table>
        <?php
        echo "</main>";
        $this->piePaginaShow(); 
    }
}

?>