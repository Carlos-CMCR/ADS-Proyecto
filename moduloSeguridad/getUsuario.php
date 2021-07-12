<?php 

if(isset($_POST["btnIngresar"])){
    $username = strtolower(trim($_POST['username']));
	$password = trim($_POST['password']);
    
    if(strlen($username) >=4 and strlen($password)>=4 ){

    }else{
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje -> formMensajeSistemaShow("Los datos ingresados son invalidos, intetalo nuevamente !!!","<a href='../index.php' class='form-message__link'>Volver</a>");
    }

}else{
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje -> formMensajeSistemaShow("ACCESO NO PERMITIDO !!!","<a href='../index.php' class='form-message__link'>Volver</a>");
}
?>