<?php
include_once "../shared/formulario.php";
class formRegistrarIncidencia extends formulario
{
    public function __construct($informacion)
    {
        $this->path = "..";
        $this->encabezadoShow("Formulario Registrar Incidencia", $informacion);
    }

    public function formRegistrarIncidenciaShow()
    {
        echo "<main class='wrapper-actions'>";
?>
        <div>
            <h1>Registrar Incidencia</h1>

            <div>
                <form action="getIncidencia.php" method="post">
                    <table class="lista-form">
                        <tr>
                            <th>Fecha: </th>
                            <td><input type="date" name="fecha"></td>
                        </tr>
                        <tr>
                            <th>Hora: </th>
                            <td><input type="time" name="hora"></td>
                        </tr>
                        <tr>
                            <th>Asunto: </th>
                            <td><input type="text" name="asunto"></td>
                        </tr>
                        <tr>
                            <th>Descripcion: </th>
                            <td><textarea type="text" name="descripcion"></textarea></td>
                        </tr>
                        <tr>
                            <th>Estado: </th>
                            <td><input type="text" name="estado" value="pendiente" disabled></td>
                        </tr>
                    </table>
                    <div>
                        <input class="verde-form__button" style="width:50%" type="submit" name="btnRegistrar" value="Confirmar">
                    </div>
                    <br>
                </form>
                <div class="lista-form">
                    <form action='../moduloSeguridad/getUsuario.php' method='post'>
                        <button class="volver-form__button" style="width:50%" name="btnInicio" type="submit">Volver</button>
                        <form>
                </div>
            </div>

            <?php
            echo "</main>";
            ?>

    <?php
        $this->piePaginaShow();
    }
}
    ?>