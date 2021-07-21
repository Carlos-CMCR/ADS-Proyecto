<?php

require_once __DIR__ ."/Usuario.php";
require_once __DIR__ ."/Producto.php";
require_once __DIR__ ."/Proforma.php";
require_once __DIR__ ."/ComprobanteDePago.php";
require_once __DIR__ ."/TipoDeServicio.php";
require_once __DIR__ ."/UsuarioPrivilegio.php";

class FactoryModels{
    public static function getModel($name){
        $model = null;
        switch($name){
            case "usuario":
                $model = new Usuario;
                break;
            case "producto":
                $model = new Producto;
                break;
            case "proforma":
                $model = new Proforma;
                break;
            case "comprobante":
                $model = new ComprobanteDePago;
                break;
            case "tipodeservicio":
                $model = new TipoDeServicio;
                break;
            case "usuarioPrivilegio":
                $model = new UsuarioPrivilegio;
                break;
        }
        return $model;
    }
}

?>