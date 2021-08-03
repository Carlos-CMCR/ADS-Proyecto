<?php 
  include_once("../shared/formulario.php");
    class formEditarServicio extends formulario{
      public function __construct($informacion){
          $this->path = "..";
          $this->encabezadoShow("Formulario Editar Servicio",$informacion);
      }
      
      public function formEditarServicioShow($datosServicio,$estadosServicio, $id_servicio){
        echo "<main class='wrapper-actions'>";
        
        ?>
<div>
    <h1>Editar Servicio</h1>

    <form action="getServicios.php" method="post">
        <table class="lista-form">

            <tr>
                <th>Nro Comprobante</th>
                <td><input type="text"
                        value="<?php if($datosServicio){echo $datosServicio[0]['numero_comprobante'];} ?>" disabled>
                </td>
            </tr>
            <tr>
                <th>Servicio</th>
                <td><input type="text" value="<?php echo $datosServicio[0]['nombre']?>" disabled></td>
            </tr>

            <tr>
                <th>Cliente</th>
                <td><input type="text" value="<?php echo $datosServicio[0]['cliente']?>" disabled></td>
            </tr>
            <tr>
                <th>dni</th>
                <td><input type="text" value="<?php echo $datosServicio[0]['dni']?>" disabled></td>
            </tr>
            <tr>
                <th>Fecha</th>
                <td><input type="date" name="fecha" value="<?php echo $datosServicio[0]['fecha']?>"></td>
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
                <td><input type="text" name="direccion" value="<?php echo $datosServicio[0]['direccion']?>"></td>
            </tr>

            <tr>
                <th>Estado</th>
                <td>
                    <select type="submit" name="estado">
                        <?php 
                  foreach($estadosServicio as $estado){
                    ?>
                        <option value="<?php echo $estado['id_estadoservicio']?>" <?php  
                      if($estado['nombreServicio'] == $datosServicio[0]['estado']) echo "selected" ?>>
                            <?php echo $estado['nombreServicio']?></option>
                        <?php 
              }
              ?>
                    </select> </td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>

                    <input type="text" name="descripcion" value="<?php echo $datosServicio[0]['descripcion']?>"></td>
            </tr>

        </table>
        <div>
            <input type="hidden" name="idServicio" value="<?php echo $id_servicio?>">
            <button class="" name="btnActualizarServicio" type="submit">Actualizar</button>
        </div>
    </form>
</div>
<div class="lista-form">
    <form action="getServicios.php" method="post">
        <button class="volver-form__button" name="btnAgendarServicio" type="submit">Volver</button>


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