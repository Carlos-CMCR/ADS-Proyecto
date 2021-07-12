<?php

include_once("./shared/formulario.php");

class formAutenticarUsuario extends formulario{
    public function __construct(){
        $this->encabezadoShowIni("Autenticar Usuario");
    }

    public function formAutenticarUsuarioShow(){
        
        ?>
    
            <div class="form-login" method="post" action="">
                <h1 class="form-login__title">Iniciar Sesión</h1>
                <div class="form-login__inputs">
                    <input type="text" class="form-login__input" placeholder="Username" name="username">
                    <input type="text" class="form-login__input" placeholder="Password" name="password">
                </div>
                <button type="submit" class="form-login__action">
                <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </button>
            </div>
        <?php 
        $this->piePaginaShow();
    }
}

?>