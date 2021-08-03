<?php 
  include_once("../shared/formulario.php");
    class formAgregarServicio extends formulario{
      public function __construct($informacion){
          $this->path = "..";
          $this->encabezadoShow("Formulario Agregar Servicio",$informacion);
      }
      
      public function formAgregarServicioShow($datosCliente){
        echo "<main class='wrapper-actions'>";
        ?>
        <div>
           <h1>Agendar Servicio</h1>

           <div>
             <form method="post" action="getServicios.php">
              <input type="text" maxlength="8" name="numComprobante">
              <button class="" name="btnBuscarNum" type="submit" >Buscar</button>
      
             </form>
             <br/>
           </div>
            <?php if(empty($datosCliente)){

            }else{ ?>
           <form action="getServicios.php" method= "post">
           <table class="lista-form"> 
           
              <tr>
               <th>Nro Comprobante</th>
               <td><input type="text" value="<?php echo $datosCliente[0]['numero_comprobante']?>" disabled></td>
             </tr>
             <tr>
               <th>Servicio</th>
               <td><input type="text" value="<?php echo $datosCliente[0]['tipo']?>" disabled></td>
             </tr>
             
             <tr>
               <th>Cliente</th>
               <td><input type="text" value="<?php echo $datosCliente[0]['nombres']?>" disabled></td>
             </tr>
             <tr>
               <th>dni</th>
               <td><input type="text" value="<?php echo $datosCliente[0]['dni']?>" disabled></td>
             </tr>
             <tr>
               <th>Fecha</th>
               <td><input type="date" name="fecha"  ></td>
             </tr>
             <tr>
               <th>Hora</th>
               <td>
               <select type="submit" name="hora">
               
                 <option value="1:00pm">1:00 pm</option>
                 <option value="2:00pm">2:00 pm</option>
                 <option value="3:00pm">3:00 pm</option>
                 <option value="4:00pm">4:00 pm</option>
                 <option value="5:00pm">5:00 pm</option>
                 <option value="6:00pm">6:00 pm</option>
                 
               </select>
              </td>
             </tr>
             <tr>
               <th>Dirección</th>
               <td><input type="text" name="direccion"  ></td>
             </tr>
             
             <tr>
               <th>Estado</th>
               <td><input type="text" name="estado" value="no atendido"  disabled></td>
             </tr>
             <tr>
               <th>Descripción</th>
               <td>
               
               <input type="text" name="descripcion" ></td>
             </tr>
          
        </table >
              <div>
              <input type="hidden" name="numComprobante" value="<?php echo $datosCliente[0]['numero_comprobante']?>" >
              <input type="hidden" name="idComprobanteServicio" value="<?php echo $datosCliente[0]['id_detallecomprobanteservicio']?>">
              <input type="hidden" name="idCliente" value="<?php echo $datosCliente[0]['id_cliente'] ?>" >
              <button class="" name="btnAgregarServicio" type="submit" >Agendar</button>
              </div>
        </form> 

        <?php } ?>
        </div>
        <div class="lista-form" >
        <form action="getServicios.php" method= "post" >
            <button class="volver-form__button" name="btnAgendarServicio" type="submit" >Volver</button>
            

        <form>
            
        </div>
        <?php
        echo "</main>";
        ?>
              
        <?php
        $this->piePaginaShow(); 
    }
}
?>     