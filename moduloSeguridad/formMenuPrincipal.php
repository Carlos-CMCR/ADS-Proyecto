<?php 
include_once("../shared/formulario.php");
class formMenuPrincipal extends formulario{
    public function __construct($username,$informacion){
        $this->path = "..";
        $this->encabezadoShow("Bienvenido : $username",$informacion);
    }

    public function formMenuPrincipalShow($listaPrivilegios = []){
        echo "<main class='wrapper-actions'>";
        foreach ($listaPrivilegios as $privilegio) {
            ?>
            <form action="<?php echo $privilegio['url']?>" method="post" class="action-form">
                <button type="submit" name="<?php echo $privilegio['boton_proceso']?>" class="action-form__button">
                    <?php echo $privilegio["nombre_proceso"]?>
                </button>
            </form>
            <?php 
        }
        echo "</main>";
        $this->piePaginaShow(); 
    }
}


?>
