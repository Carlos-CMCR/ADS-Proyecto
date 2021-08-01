<?php 
include_once("../shared/formulario.php");
class formListarIncidencias extends formulario{
    public function __construct($informacion){
        $this->path = "..";
        $this->encabezadoShow("Formulario Listar Incidencias",$informacion);
    }

    public function formListarIncidenciasShow($listarIncidencias = []){
        
        date_default_timezone_set('America/Bogota');
        echo "<main class='wrapper-actions'>";
        if(isset($_POST['fecha'])){
            $today = $_POST['fecha'];
        }else{ 
            $today = date('Y-m-d'); 
        }

        ?>
         <script src="../public/estadosIncidencias.js"></script>
         <h1>Reporte de Incidencias</h1>
        <div class="lista-form">
            <h3>Seleccionar búsqueda :</h3>
            <form action="getIncidencia.php" method="post" >
            <label><input type="checkbox" name="sinFecha" value="1" onClick="habilitaDeshabilita(this.form)">Sin Fecha</label>
            <input type="date" class="form-date" value="<?php echo $today; ?>" name = "fecha" >
            <label><input type="checkbox" name="pendiente" value="0" onClick="habilitaestado(this.form)">Pendiente</label>
            <label><input type="checkbox" name="realizado" value="1" onClick="deshabilitaestado(this.form)">Realizado</label>
            <button type="submit" class="buscar-form__button" name="btnBuscar">Buscar</button>
            </form>
        </div>
        <table class="lista-form">
            <tr>
                <th>Asunto</th>
                <th>Usuario</th>
                <th>Descipción</th>
                <th>Fecha de Notificación</th>
                <th>Hora Notificada</th>
                <th>Fecha de Resolución</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            
            <?php
            foreach ($listarIncidencias as $incidencias) {
                ?>
                <form action="getIncidencia.php" method= "post">
                <tr>
                    <input type="hidden" name="idEstadoIncidencia" value="<?php echo $incidencias["id_estadoincidencia"]; ?>">
                    <input type="hidden" name="idIncidencia" value="<?php echo $incidencias["id_incidencias"]; ?>">
                    <td align="center" ><?php echo $incidencias["asunto"]?></td>
                    <td align="center"><?php echo $incidencias["nombres"];?> <?php echo $incidencias["apellido_paterno"];?> <?php echo $incidencias["apellido_materno"];?></td>
                    <td align="center"><?php echo $incidencias["descripcion"]?></td>
                    <td align="center"><?php echo $incidencias["fecha_notificada"]?></td>
                    <td align="center"><?php echo $incidencias["hora_notificada"]?></td>
                    <td align="center">
                        <?php if($incidencias['fecha_resolucion']){
                        echo $incidencias["fecha_resolucion"];
                        
                        }else { echo "aa/mm/dd";}?></td>
                    <td align="center"><?php echo $incidencias["nombre_estado"]?></td>
                    <td>
                     <?php if($incidencias['id_estadoincidencia']){
                        ?><button  type="submit" class="modal__action modal__action--cancelar" name="btnModificar" disabled>Modificar</button><?php
                     }else{ ?>
                        <button  type="submit" class="lista-form__button" name="btnModificar">Modificar</button>
                    <?php }?>
                    </td>
                </tr>
                </form>
        
                <?php 
            }?>
        </table>   
        <div class="modal-actions">
          <form action='../moduloSeguridad/getUsuario.php'  method='post'>
             <button class="modal__action modal__action--cancelar" type="submit" name="btnInicio">Volver</button>
          </form>
          <form action='getIncidencia.php'  method='post'>
            <button class="modal__action modal__action--continuar" type="submit" name="btnImprimir">Imprimir</button>
          </form>
        </div>
        
        
        <?php
        echo "</main>";
        $this->piePaginaShow(); 
    }
}


?>