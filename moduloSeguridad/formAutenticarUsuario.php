<?php

include_once("./shared/formulario.php");

class formAutenticarUsuario extends formulario{
    public function __construct(){
        $this->encabezadoShowIni("Autenticar Usuario");
    }

    public function formAutenticarUsuarioShow(){
        
        ?>
    
            <div class="form-login" method="post" action="">
                <h1 class="form-login__title">Inicias Sesión</h1>
                <div class="form-login__inputs">
                    <input type="text" class="form-login__input" placeholder="Username" name="username">
                    <input type="text" class="form-login__input" placeholder="Password" name="password">
                </div>
                <input type="submit" class="form-login__action" value="Iniciar Session">
            </div>
        <?php 
        $this->piePaginaShow();
    }
}

?>