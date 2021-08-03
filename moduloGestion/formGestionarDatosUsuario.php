<?php 
include_once("../shared/formulario.php");
class formGestionarDatosUsuario extends formulario{
    public function __construct($informacion){
        $this->path = "..";
        $this->encabezadoShow("Formulario de Gestionar datos de Usuarios",$informacion);
    }

    public function formGestionarDatosUsuarioShow(){
        echo "<main class='wrapper-actions'>";
        ?>
        <div align="center" class="lista-form">
            <h3>Elegir Opcion :</h3>
            <form action="getGestionarUsuario.php" method="post" >
            <button type="submit" class="buscar-form__button" name="btnRegistrar">Registrar nuevo Usuario</button>
            <button type="submit" class="buscar-form__button" name="btnEditarUsuario">Editar usuario existente</button>
            </form>
            
        </div>
        <div class="lista-form">
        <form action='../moduloSeguridad/getUsuario.php'  method='post'>
            <button class="volver-form__button" name="btnInicio" type="submit" >Volver</button>
        </form>
        </div>
        <?php
        echo "</main>";
        $this->piePaginaShow(); 
    }
}
?>