<?php 
include_once("../shared/formulario.php");

class formModificarProducto extends formulario{
    public function __construct($informacion){
        $this->path = "..";
        $this->encabezadoShow("Formulario Modificar Producto",$informacion);
    }

    public function formModificarProductoShow($producto= [],$observaciones = [],$categorias = [],$marcas = [], $estados = []){
        var_dump($observaciones);
        ?>
        <main class="wrapper-actions">
        
        <form action='getGestionarInventario.php'  method='post'>
                <h1>Modificar Producto</h1>
                <table class="lista-form">
                    <tr>
                        <th>Código:</th>
                        <input type="hidden" name= "idProducto" value="<?php echo $producto['id_producto']?>" >
                        <td><input type="text"  value="<?php echo $producto['codigo_producto'] ?>" disabled></td>            
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td><input type="text" name="nombre" value="<?php echo $producto['nombre'] ?>"></td>                
                    </tr>
                    <tr>
                        <th>Stock:</th>
                        <td><input type="number"  min="1" name="stock" value="<?php echo $producto['stock'] ?>"></td>                
                    </tr>
                    <tr>
                        <th>Precio:</th>
                        <td><input type="number" step="0.01" min="1"   name="precioUnitario" value="<?php echo $producto['precioUnitario'] ?>"></td>                
                    </tr>
                    <tr>
                        <th>Categoría:</th>
                        <!-- tambien otro select -->
                        <td>
                        <select name="idCategoria">
                            <?php 
                            foreach ($categorias as $categoria) {
                                ?>
                                <option  value="<?php echo $categoria['id_categoria']?>"
                                <?php 
                                    if($categoria['id_categoria'] == $producto["id_categoria"]) echo "selected"
                                ?>
                                > <?php echo $categoria['nombre_categoria']?></option>
                                <?php 
                            }
                            ?>
                        </select>
                        </td>      
                    </tr>
                    <tr>
                        <th>Marca:</th>
                        <!-- tambien otro select -->
                        <td>
                        <select name="idMarca">
                            <?php 
                            foreach ($marcas as $marca) {
                                ?>
                                <option value="<?php echo $marca['id_marca']?>"
                                <?php 
                                    if($marca['id_marca'] == $producto["id_marca"]) echo "selected"
                                ?>
                                > <?php echo $marca['marca_nombre']?></option>
                                <?php 
                            }
                            ?>
                        </select>     
                        </td> 
                                        
                    </tr>
                    <tr>
                        <th>Descripción:</th>
                        <td><textarea name="descripcion" id="" cols="30" rows="10"><?php echo $producto['descripcion'] ?>
                        </textarea></td>
                    </tr>
                    <tr> 
                        <th>Observación:</th>
                        <td>
                        <select name="idObservacion">
                            <?php 
                            foreach ($observaciones as $observacion) {
                                ?>
                                <option value="<?php echo $observacion['id_observacion']?>"
                                <?php 
                                    if($observacion['id_observacion'] == $producto["id_observacion"]) echo "selected"
                                ?>
                                > <?php echo $observacion['nombre_observacion']?></option>
                                <?php 
                            }
                            ?>
                        </select>     
                        </td>           
                    </tr>

                    <tr> 
                        <th>Estado:</th>
                        <td>
                        <select name="idEstadoEntidad">
                            <?php 
                            foreach ($estados as $estadoentidad) {
                                ?>
                                <option value="<?php echo $estadoentidad['id_estadoEntidad']?>"
                                <?php 
                                    if($estadoentidad['id_estadoEntidad'] == $producto["id_estadoEntidad"]) echo "selected"
                                ?>> 
                                <?php echo $estadoentidad['nombre_estado']?></option>
                                <?php 
                            }
                            ?>
                        </select>     
                        </td>           
                    </tr>
                        
                </table>
                <div class="lista-form">
        
            <button class="volver-form__button" name="btnGestionarInventario" type="submit" >Atrás</button>
            <input type="hidden" name="codigo_producto" value="<?php echo $producto['codigo_producto'] ?>" >
            <button class="verde-form__button" name="btnActualizar" type="submit" >Actualizar</button>
            
        </form>
            
        </div>
            </main>

     
        
        <?php
        echo "</main>";
        $this->piePaginaShow(); 
    }
}

?>