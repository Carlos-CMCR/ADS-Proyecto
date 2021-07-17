<?php 
  include_once("../shared/formulario.php");
    class formBoletaGenerada extends formulario{
      public function __construct($informacion){
          $this->path = "..";
          $this->encabezadoShow("Formulario Boleta Generada",$informacion);
      }

      public function formBoletaGeneradaShow($datosProforma=[],$tiposServicio = []){
          echo "llegue";
      }
    }
?>