<?php

include_once("./shared/formulario.php");

class formAutenticarUsuario extends formulario{
    public function __construct(){
        $this->path = ".";
        $this->encabezadoShowIni("Autenticar Usuario");
    }

    public function formAutenticarUsuarioShow(){
        
        ?>
    
            <form class="form-login" method="post" action="./moduloSeguridad/getUsuario.php">
                <h1 class="form-login__title">Iniciar Sesión</h1>
                <div class="form-login__inputs">
                    <input type="text" class="form-login__input" placeholder="Username" name="username">
                    <input type="password" class="form-login__input" placeholder="Password" name="password">
                </div>
                <button type="submit" class="form-login__action" name="btnIngresar">
                <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </button>
            </form>
        <?php 
        $this->piePaginaShow();
    }
}

?>