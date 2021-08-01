<?php 
if(isset($_POST["btnEmitirReporteIncidencias"])){
    session_start(); 
    include_once("./controllerEmitirReporteIncidencias.php");
    $controlIncidencias = new controllerEmitirReporteIncidencias;
    $controlIncidencias -> obtenerIncidencias();

}elseif(isset($_POST["btnBuscar"])){
    if (isset($_POST["fecha"])) {
        $fecha_seleccionada = ($_POST['fecha']);
        ?>
        <form action="formListarIncidencias.php" method="post" >
        <input type="hidden" class="form-date" value ="<?php echo $fecha_seleccionada; ?>" name = "fecha"></form>
        <?php 
        if(!isset($_POST['pendiente']) && !isset($_POST['realizado'])){
            include_once("./controllerEmitirReporteIncidencias.php");
            $controlIncidencias = new controllerEmitirReporteIncidencias;
            $controlIncidencias -> obtenerIncidenciasFecha($fecha_seleccionada);
        }

        elseif(isset(($_POST['pendiente'])) xor isset($_POST['realizado'])){
            if (isset($_POST['pendiente']) ) {
                $estado = $_POST["pendiente"];
            }else{
                $estado = $_POST["realizado"];
            }
            include_once("./controllerEmitirReporteIncidencias.php");
            $controlIncidencias = new controllerEmitirReporteIncidencias;
            $controlIncidencias -> obtenerIncidenciasFechayEstado($fecha_seleccionada,$estado);
        }
    }
    
    elseif(isset($_POST["sinFecha"])){
        if(isset($_POST['pendiente']) xor isset($_POST['realizado'])){
            
            if (isset($_POST['pendiente']) ) {
                $estado = $_POST["pendiente"];
            }else{
                $estado = $_POST["realizado"];
            }
            include_once("./controllerEmitirReporteIncidencias.php");
            $controlIncidencias = new controllerEmitirReporteIncidencias;
            $controlIncidencias -> obtenerIncidenciasTotalEstado($estado);
        }
        
        elseif(isset($_POST['realizado']) && isset($_POST['pendiente']) ){
            include_once("./controllerEmitirReporteIncidencias.php");
            $controlIncidencias = new controllerEmitirReporteIncidencias;
            $controlIncidencias -> obtenerIncidenciasTotal();
        }
        else{
            $mensaje = "Debe eligir un estado o ambos";
            include_once("../shared/formMensajeSistema.php");
                $nuevoMensaje = new formMensajeSistema;
                $nuevoMensaje -> formMensajeSistemaShow(
                    $mensaje,
                    "<form action='getIncidencia.php' class='form-message__link' method='post' style='padding:0;'>
                        <input name='btnEmitirReporteIncidencias'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>");
    
        }

    }

}elseif(isset($_POST["btnModificar"])){
    session_start(); 
    $id_incidencias = ($_POST['idIncidencia']);
    include_once("./controllerEmitirReporteIncidencias.php");
    $controlIncidencias = new controllerEmitirReporteIncidencias;
    $controlIncidencias -> obtenerDetalleIncidencia($id_incidencias);

}elseif(isset($_POST["btnGuardar"])){ 
    $id_incidencias = $_POST['idIncidencia'];  
    $estado = $_POST['estado'];

    include_once("../shared/formAlerta.php");
    $alert = new formAlerta;
    $alert->formAlertaGeneralShow("¿Esta seguro que desea modificar la incidencia?","
            <form action='getIncidencia.php' method='post'>
            <input type='hidden' name='idIncidencia' value='$id_incidencias'>
            <input type='hidden' name='estado' value='$estado'>
            <button type='submit' name='btnActualizarIncidencia' >Continuar</button>
            </form>
            <form action='getIncidencia.php' method='post'>
            <input type='hidden' name='idIncidencia' value='$id_incidencias'>
            <button type='submit' name='btnModificar' >Cancelar</button>
            </form>
            ");
   
}else if(isset($_POST["btnActualizarIncidencia"])){ 
        date_default_timezone_set('America/Bogota');
    $id_incidencias = $_POST['idIncidencia'];  
    $estado = $_POST['estado'];
    $fecha_resolucion =  date('Y-m-d'); 
                            
    Include_once("./controllerEmitirReporteIncidencias.php");
    $controlIncidencias = new controllerEmitirReporteIncidencias;
    $controlIncidencias -> actualizarDatosIncidencia($fecha_resolucion, $estado,$id_incidencias);          

}else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("¡ACCESO NO PERMITIDO!","<a href='../index.php' class='form-message__link'>Volver</a>");
}


?>