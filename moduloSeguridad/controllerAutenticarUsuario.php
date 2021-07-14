<?php 

class controllerAutenticarUsuario{
    public function validarUsuario($username,$password)
		{
			include_once("../model/Usuario.php");
			$objUsuario = new Usuario;
			$respuesta = $objUsuario -> verificarUsuario($username,$password);
			if($respuesta["existe"]){
				session_start();
				include_once("../model/UsuarioPrivilegio.php");
				$objprivilegio = new UsuarioPrivilegio;
				$listaPrivilegios = $objprivilegio -> obtenerPrivilegios($username);
				$informacion = $objUsuario->obtenerInformacionDelUsuario($username); 
				$_SESSION['username']= $username;
				$_SESSION['informacion']= $informacion;
				include_once("formMenuPrincipal.php");
				$objMenu = new formMenuPrincipal($username,$informacion);
				$objMenu -> formMenuPrincipalShow($listaPrivilegios);
			}
			else
			{
				include_once("../shared/formMensajeSistema.php");
				$nuevoMensaje = new formMensajeSistema;
				$nuevoMensaje -> formMensajeSistemaShow($respuesta["mensaje"],"<a href='../index.php' class='form-message__link'>ir al inicio</a>");
			}
		}
}
?>