<?php 
  include_once("../shared/formulario.php");
class formBoletaGenerada extends formulario{
    public function __construct($informacion){
        $this->path = "..";
        $this->encabezadoShow("Formulario Boleta Generada",$informacion);
    }

    public function formBoletaGeneradaShow($id_proforma, $datosProforma=[],$tiposServicio = []){
        $datosProformaProductos = $datosProforma["datosProformaProductos"];
        $datosProformaServicios = $datosProforma["datosProformaServicios"];
        ?>
        <main class='wrapper-actions'>
            <div style="width:100% ">
                <h2 align="center">Información de Boleta </h2>
            </div>
            <div>
                <table class="lista-form">
                    <tr>
                        <th>Nombre:</th>
                        <td><?php echo $datosProformaProductos[0]['nom_client']." ".$datosProformaProductos[0]['apellido_paterno']." ".$datosProformaProductos[0]['apellido_materno']  ?></td>            
                    </tr>
                    <tr>
                        <th>DNI:</th>
                        <td><?php echo $datosProformaProductos[0]['dni'] ?></td>                
                    </tr>
                    <tr>
                        <th>Teléfono:</th>
                        <td><?php echo $datosProformaProductos[0]['celular'] ?></td>                
                    </tr>
                        
                </table>
            </div>
            <div style="width:100%;">
                <table style="width:100%;" id="table_productos_proforma" data-idproforma="<?php echo $id_proforma ?>">
                    <?php 
                    foreach ($datosProformaProductos as $dato){
                        ?> 
                        <tr>
                        <td><button type="button" data-idproducto="" >X</button> </td>      
                        <td><p><?php echo $dato['nom_product'] ?></p></td>
                        <td><input type="number" value="<?php echo $dato['cantidad'] ?>" min="1" max="<?php echo $dato['stock']?>"></td>
                        <td><input type="string" value="<?php echo $dato['precioProduct']*$dato['cantidad'] ?>" disabled></td>
                        
                        </tr>
                        <?php 
                    }
                    ?>
                </table>
            </div>
            <div style="width:100%;">
                <form action="getComprobantePago.php" method= "post">
                <input type="hidden" value="<?php echo $id_proforma ?>" name="idProforma" >
                    <input type="submit" name="btnAgregarProducto" value="Agregar">
                </form>
            </div>
            <div>
                <?php
                    foreach ($tiposServicio as $tipo) {
                        ?>
                        <div>
                            <label for="<?php echo $tipo['nombre']?>" ><?php echo $tipo['nombre']?></label>
                            <input type="checkbox" name="" id="<?php echo $tipo['nombre']?>"
                            <?php
                            if(count($datosProformaServicios)){
                                if(count($datosProformaServicios) == 1){
                                    if($tipo['id_tipo']==$datosProformaServicios[0]["id_tiposervicio"]){
                                        echo "checked";
                                    }
                                }else{
                                    if($tipo['id_tipo']==$datosProformaServicios[0]["id_tiposervicio"] or $tipo['id_tipo']==$datosProformaServicios[1]["id_tiposervicio"]){
                                        echo "checked";
                                    }
                                }
                            }
                            
                            ?> >
                            <label for="<?php echo $tipo['precioDeServicio']?>" >S/. <?php echo $tipo['precioDeServicio']?></label>
                        </div>
                        <?php 
                    }
                ?>
            </div>
            <div style="width:100%;">
                <table class="lista-form">
                    <tr>
                        <th>Subtotal: </th>
                        <td><?php echo $datosProformaProductos[0]['subtotal']  ?></td>            
                    </tr>
                    <tr>
                        <th>IGV: </th>
                        <td><?php echo $datosProformaProductos[0]['igv'] ?></td>                
                    </tr>
                    <tr>
                        <th>Precio Total: </th>
                        <td><?php echo $datosProformaProductos[0]['precioTotal'] ?></td>                
                    </tr>
                       
                </table>
            </div>
            <div class="lista-form">
                <form action="getComprobantePago.php" method= "post">
                    <input class="volver-form__button" name="btnEmitirComprobante" type="submit" value="Volver" >
                    <input class="verde-form__button" type="submit"  name="btnConfirmarFactura" value="Confirmar">
                    
                <form>
            </div>
            
        </main>
        <script src="<?php echo $this->path ?>/public/comprobante.js"></script>
        <?php 
        $this->piePaginaShow();
      }
    }
?>