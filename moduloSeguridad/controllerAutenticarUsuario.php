<?php 

class controllerAutenticarUsuario{
    public function validarUsuario($username,$password)
		{
			include_once("../model/Usuario.php");
			$objUsuario = new Usuario;
			$respuesta = $objUsuario -> verificarUsuario($username,$password);
			///if($objUsuario -> verificarUsuario($login,$password) == 1)
			if($respuesta["existe"]){
				echo "si existe";
				// session_start();
				// include_once("../model/usuarioPrivilegio.php");
				// $objprivilegio = new usuarioPrivilegio;
				// $listaPrivilegios = $objprivilegio -> obtenerPrivilegios($login);
				// $_SESSION['login']= $login;
				// include_once("formMenuPrincipal.php");
				// $objMenu = new formMenuPrincipal($login);
				// $objMenu -> formMenuPrincipalShow($listaPrivilegios);
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