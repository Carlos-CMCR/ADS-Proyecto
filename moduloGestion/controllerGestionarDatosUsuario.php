<?php 

class controllerGestionarDatosUsuario{ 
    public function obtenerGestionarDatosUsuarios(){
        include_once("formGestionarDatosUsuario.php");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
        $objGestionarDatos= new formGestionarDatosUsuario($_SESSION["informacion"]);
        $objGestionarDatos -> formGestionarDatosUsuarioShow();
    }
    public function editarDatosUsuario(){
        include_once("formBuscar.php");
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }
        $objBuscarDatos = new formBuscar($_SESSION["informacion"]);
        $objBuscarDatos ->formBuscarShow();
    }
    public function buscarDatos($username){
        include_once("../model/FactoryModels.php");
        $objUsuario = FactoryModels::getModel("usuario");
        $datosUsuario = $objUsuario -> obtenerDatosUsuario($username);
        $datosRoles = $objUsuario-> obtenerRoles();
        $datosEstado = $objUsuario-> obtenerEstado();
        if($datosUsuario["existe"]){
            include_once("formEditarUsuario.php");
            session_start();
            $objListaDatos = new formEditarUsuario($_SESSION["informacion"]);
            $objListaDatos -> formEditarUsuarioShow($datosUsuario["data"],$datosRoles,$datosEstado);
        }else{
            include_once("../shared/formMensajeSistema.php");
                $nuevoMensaje = new formMensajeSistema;
                $nuevoMensaje -> formMensajeSistemaShow(
                $datosUsuario["mensaje"],
                    "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                        <input name='btnEditarUsuario'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                    </form>");
        }
    }
    public function confirmarEditarUsuario($nombre, $apaterno, $amaterno, $username, $estado, $email,$celular,$rol){
        include_once("../model/FactoryModels.php");
        include_once("../shared/formMensajeSistema.php");
        $objUsuario = FactoryModels::getModel("usuario");
        $nuevoMensaje = new formMensajeSistema;
        $verificarEditarUsuario = $objUsuario -> verificarEditarUsuario($username,$email,$celular);
        $verificador="";
        if($verificarEditarUsuario["existe"]){
            foreach($verificarEditarUsuario["data"] as $datos){ 
                if($datos['email']==$email){
                        $verificador = "email";
                    }else if($datos['celular']==$celular){
                        $verificador = "celular";
                    }}
            $nuevoMensaje -> formMensajeSistemaShow("¡El $verificador esta siendo usado, por favor ingrese otro $verificador !","<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
            <input type='text' name= 'username' value=$username hidden>  
            <input name='btnBuscar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Aceptar' type='submit'>
            </form>");
        }
        else{
            include_once("../shared/formAlerta.php");
                    $alert = new formAlerta;
                    $alert->formAlertaGeneralShow("¿Esta seguro que desea editar el Usuario?","
                    <form action='getGestionarUsuario.php' method='post'>
                    <input type='hidden' name='nombre' value='$nombre'>
                    <input type='hidden' name='apaterno' value='$apaterno'>
                    <input type='hidden' name='amaterno' value='$amaterno'>
                    <input type='hidden' name='username' value='$username'>
                    <input type='hidden' name='estado' value='$estado'>
                    <input type='hidden' name='email' value='$email'>
                    <input type='hidden' name='celular' value='$celular'>
                    <input type='hidden' name='rol' value='$rol'>
    
                    <button type='submit' name='btnContinuarEditar' >Continuar</button>
                    </form>
                    <form action='getGestionarUsuario.php' method='post'>
                    <input type='hidden' name= 'username' value='$username'> 
                    <button type='submit' name='btnBuscar' >Cancelar</button>
                    </form>
                    ");
        }
    }
    public function editarUsuario($nombre, $apaterno, $amaterno, $username, $estado, $email,$celular,$rol){
        include_once("../model/FactoryModels.php");
        include_once("../shared/formMensajeSistema.php");
        $objUsuario = FactoryModels::getModel("usuario");
        $nuevoMensaje = new formMensajeSistema;
        
        $editarUsuario = $objUsuario -> editarUsuario($nombre, $apaterno, $amaterno, $username, $estado, $email,$celular,$rol);
        
        if($editarUsuario["success"]){
            $nuevoMensaje -> formMensajeSistemaShow(
            $editarUsuario["mensaje"],
                "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                    <input name='btnGestionarDatosDelUsuario'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                </form>",true);
            }
        else{
            $nuevoMensaje -> formMensajeSistemaShow(
                $editarUsuario["mensaje"],
                    "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                        <input name='btnGestionarDatosDelUsuario'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                    </form>");
        }

    } 
}

?>