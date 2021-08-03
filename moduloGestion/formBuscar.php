<?php 
include_once("../shared/formulario.php");
class formBuscar extends formulario{
    public function __construct($informacion){
        $this->path = "..";
        $this->encabezadoShow("Formulario Buscar",$informacion);
    }

    public function formBuscarShow(){
        echo "<main class='wrapper-actions'>";
        ?>
        <div align = "center"class="lista-form">
            <h3>Ingresar Usuario:</h3>
            <form action="getGestionarUsuario.php" method="post" >
            <input type="text" class="form-date" placeholder="Username" name = "username">
            <button type="submit" class="buscar-form__button" name="btnBuscar">Buscar</button>
            </form>
            
        </div>
        <div align = "center" class="lista-form">
        <form action='getGestionarUsuario.php'  method='post'>            
            <button class="volver-form__button" name="btnGestionarDatosDelUsuario" type="submit" >Volver</button>
        </form>
        </div>
        <?php
        echo "</main>";
        $this->piePaginaShow(); 
    }
}
?>