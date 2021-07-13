<?php 
include_once("../shared/formulario.php");
class formListaProformas extends formulario{
    public function __construct(){
        $this->path = "..";
        $this->encabezadoShow("Formulario Listar Proformas");
    }

    public function formListaProformasShow($listarProformas = []){
        echo "<main class='formLista-actions'>";
        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $today = $year . '-' . $month . '-' . $day;
        ?>
        <div class="lista-form">
            <h3>Seleccionar fecha:</h3>
            <form action="getComprobantePago.php" method="post" >
            <input type="date" class="form-date" value="<?php echo $today; ?>" name = "fecha">
            <button type="submit" class="buscar-form__button" name="btnBuscar">Buscar</button>
            </form>
            
        </div>
        <table class="lista-form">
            <tr>
                <th>Cod Proforma</th>
                <th>Fecha Emisión</th>
                <th>Cliente</th>
                <th>Acción</th>
            </tr>
            
            <?php
            foreach ($listarProformas as $proforma) {
                ?>
                <tr>
                <td align="center"><?php echo $proforma["codigo_proforma"]?></td>
                <td align="center"><?php echo $proforma["fecha_emision"]?></td>
                <td align="center"><?php echo $proforma["nombres"];?> <?php echo $proforma["apellido_paterno"];?> <?php echo $proforma["apellido_materno"]?></td>
                <td><button class="lista-form__button">Seleccionar</button></td>
                </tr>
                <?php 
            }?>
            
        </table>
        <div class="lista-form">
        <form action='../moduloSeguridad/getUsuario.php'  method='post'>
            <button class="volver-form__button" name="btnInicio" type="submit" >Volver</button>
        <form>
            
        </div>
        <?php
        echo "</main>";
        $this->piePaginaShow(); 
    }
}


?>