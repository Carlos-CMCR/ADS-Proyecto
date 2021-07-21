<?php 
// include_once('./moduloSeguridad/formAutenticarUsuario.php');
include_once("./model/FacadeViews.php");
$facade = new FacadeViews;
$objFormAutenticacion  = $facade->getFormAutenticarUsuario();
$objFormAutenticacion -> formAutenticarUsuarioShow();
// $objFormAutenticacion = new formAutenticarUsuario;

?>