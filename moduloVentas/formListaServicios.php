<?php 
include_once("../shared/formulario.php");
class formListaServicios extends formulario{
    public function __construct($informacion){
        $this->path = "..";
        $this->encabezadoShow("Formulario Listar Servicios",$informacion);
    }

    public function formListaServiciosShow($listarServicios){
        echo "<main class=''>";
        
        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $today = $year . '-' . $month . '-' . $day;
        ?>
        <div class="lista-form">
            <h3>Ingresar DNI Cliente:</h3>
            <form action="getServicios.php" method="post" >
            <input type="text" class=""  name ="dni" maxlength="8" value="">
            <button type="submit" class="buscar-form__button" name="btnBuscar">Buscar</button>
            </form>
            
        </div>
        <table class="lista-form">
            <tr>
                
                <th>Nombre Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Cliente</th>
                <th>DNI</th>
                <th>Direccion</th>
                <th>Nro Comprobante</th>
                <th>Estado</th>
                <th>Descripcion</th>
            </tr>
            
            <?php
            
            foreach ($listarServicios as $servicio) {
                ?>
                <tr>
                <form action="getServicios.php" method= "post"></td>
                    <input type="hidden" class=""  name ="idServicio"  value="<?php  echo $servicio["id_servicio"]?>">
                    <td align="center" style="padding:5px"><?php  echo $servicio["nombre"]?></td>
                    <td align="center" style="padding:5px"><?php  echo $servicio["fecha"]?></td>
                    <td align="center" style="padding:5px"><?php  echo $servicio["hora"]?></td>
                    <td align="center" style="padding:5px"><?php  echo $servicio["cliente"];?> <?php  //echo $proforma["apellido_paterno"];?> <?php  //echo $proforma["apellido_materno"]?></td>
                    <td align="center" style="padding:5px"><?php  echo $servicio["dni"]?></td>
                    <td align="center" style="padding:5px"><?php  echo $servicio["direccion"]?></td>
                    <td align="center" style="padding:5px"><?php  echo $servicio["numero_comprobante"]?></td>
                    <td align="center" style="padding:5px"><?php  echo $servicio["estado"]?></td>
                    <td align="center" style="padding:5px"><?php  echo $servicio["descripcion"]?></td>
                    <td><button  type="submit" class="lista-form__button" name="btnEditar">Editar</button></td>
                </form>
                
                </tr>
                <?php 
             }?>
            
        </table>
        <div class="lista-form" align="center">
        <form action='../moduloSeguridad/getUsuario.php'  method='post'>
            <button class="volver-form__button" name="btnInicio" type="submit" >Volver</button>
           
        </form>
        <form action="getServicios.php"  method="post">
  
            <button class="buscar-form__button" name="btnAgregar" type="submit" >Nuevo</button>
        </form>
            
        </div>
        
        <?php 
        echo "</main>";
        $this->piePaginaShow(); 
    }


}
?>