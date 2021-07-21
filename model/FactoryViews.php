<?php 
include_once("../moduloSeguridad/formAutenticarUsuario.php");
class FactoryViews {
    public static function getView($name){
        $model = null;
        switch($name){
            case "AutenticarUsuario":
                $model = new formAutenticarUsuario;
        }
        return $model;
    }
}

?>