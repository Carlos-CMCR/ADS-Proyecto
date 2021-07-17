<?php 

include_once("formulario.php");
	class formMensajeSistema extends formulario
	{
		public function __construct()
		{   
            $this->path = "..";
			$this -> encabezadoShowIni("Mensaje del sistema");
		}
		public function formMensajeSistemaShow($mensaje,$enlace,$exito = false)
		{
            ?>
            <div class="form-message">
                <img src="../img/<?php echo $exito?'exito.png':'alert.png' ?>" alt="" class="form-message__img">
                <p class="form-message__content">
                    <?php echo $mensaje;?>
                </p>
                <?php echo $enlace;?>
            </div>

			<?php 
			$this -> piePaginaShow();
		}
	}
?>