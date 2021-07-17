<?php 
include_once("../shared/formulario.php");
class formCambiarPassword extends formulario{
    public function __construct($informacion){
        $this->path = "..";
        $this->encabezadoShow("Formulario Cambiar Contraseña",$informacion);
    }
    public function formCambiarPasswordShow(){
        ?>
        <main class='wrapper-actions wrapper-actions--cambiar-password form-cambiar' >
            <h1 class='form-cambiar__title'>Ingrese su contraseña actual</h1>
            <form action="getCambiarPassword.php" method="post" class="form-cambiar__actions">
                <input type="password" name="password" placeholder="Contraseña actual">
                <button btn="btnConfirmar">Confirmar</button>
            </form>
            <form action="getUsuario.php" method="post" class="form-cambiar__volver">
                <button name="btnInicio">Ir al inicio</button>
            </form>
        </main>
        <?php
        $this->piePaginaShow();  
    }
}

?>