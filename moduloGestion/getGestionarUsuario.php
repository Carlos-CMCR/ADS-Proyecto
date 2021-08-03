<?php 

if (isset($_POST["btnGestionarDatosDelUsuario"])) {
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION['lista']);
    include_once("./controllerGestionarDatosUsuario.php");
    $controlReporteVentas = new controllerGestionarDatosUsuario;
    $controlReporteVentas->obtenerGestionarDatosUsuarios();
}else if (isset($_POST["btnEditarUsuario"])) {
    include_once("./controllerGestionarDatosUsuario.php");
    $controlEditar = new controllerGestionarDatosUsuario;
    $controlEditar->editarDatosUsuario();
}else if (isset($_POST["btnBuscar"])) {

    $username = strtolower(trim($_POST['username']));

    if (strlen($username) >= 4) {
        include_once("./controllerGestionarDatosUsuario.php");
        $controlEditar = new controllerGestionarDatosUsuario;
        $controlEditar->buscarDatos($username);
    } else {
        include_once("../shared/formMensajeSistema.php");
        $nuevoMensaje = new formMensajeSistema;
        $nuevoMensaje->formMensajeSistemaShow("El username es inválido, intetalo nuevamente !!!", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
        <input name='btnEditarUsuario'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'></form>");
    }
}else if (isset($_POST["btnConfirmarEditar"])) {
    include_once("./controllerGestionarDatosUsuario.php");
    session_start();
    $nombre = trim($_POST['nombre']);
    $apaterno = trim($_POST['apaterno']);
    $amaterno = trim($_POST['amaterno']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $celular = trim($_POST['celular']);
    $estado = $_POST['estado'];
    $rol = $_POST['rol'];
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    if (strlen($nombre) < 2) {
        $nuevoMensaje->formMensajeSistemaShow("El nombre debe tener como minimo 2 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
        <input type='text' name= 'username' value=$username hidden> <input name='btnBuscar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
        </form>");
    } else {
        if (strlen($apaterno) < 4) {
            $nuevoMensaje->formMensajeSistemaShow("El Apellido Paterno debe tener como minimo 4 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
            <input type='text' name= 'username' value=$username hidden> <input name='btnBuscar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
        </form>");
        } else {
            if (strlen($amaterno) < 4) {
                $nuevoMensaje->formMensajeSistemaShow("El Apellido Materno debe tener como minimo 4 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                <input type='text' name= 'username' value=$username hidden> <input name='btnBuscar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                </form>");
            } else {
                if (strlen($username) < 4) {
                    $nuevoMensaje->formMensajeSistemaShow("El username debe tener como minimo 4 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                    <input type='text' name= 'username' value=$username hidden> <input name='btnBuscar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                </form>");
                } else {
                        if (strlen($celular) == 9) {
                            $controlEditar = new controllerGestionarDatosUsuario;
                            $controlEditar->confirmarEditarUsuario($nombre, $apaterno, $amaterno, $username, $estado, $email,$celular,$rol);
                        } else {
                            $nuevoMensaje->formMensajeSistemaShow("El celular debe tener 9", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                            <input type='text' name= 'username' value=$username hidden> <input name='btnBuscar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                    </form>");
                   } 
                }
            }
        }
    }
}elseif(isset($_POST["btnContinuarEditar"])){
    session_start();
    $nombre = trim($_POST['nombre']);
    $apaterno = trim($_POST['apaterno']);
    $amaterno = trim($_POST['amaterno']);
    $username = trim($_POST['username']);
    $estado = $_POST['estado'];
    $email = trim($_POST['email']);
    $celular = trim($_POST['celular']);
    $rol = $_POST['rol'];
    include_once("./controllerGestionarDatosUsuario.php");
    $objUsuario = new controllerGestionarDatosUsuario;
    $objUsuario-> editarUsuario($nombre, $apaterno, $amaterno, $username, $estado, $email, $celular, $rol);
} else if (isset($_POST["btnRegistrar"])) {
    include_once("./controllerGestionarDatosUsuario.php");
    $controlEditar = new controllerGestionarDatosUsuario;
    $controlEditar->registrarDatosUsuario();
} else if (isset($_POST["btnAgregarUsuario"])) {
    include_once("./controllerGestionarDatosUsuario.php");
    session_start();
    $nombre = trim($_POST['nombre']);
    $apaterno = trim($_POST['apaterno']);
    $amaterno = trim($_POST['amaterno']);
    $username = trim($_POST['username']);
    $estado = $_POST['estado'];
    $email = trim($_POST['email']);
    $dni = trim($_POST['dni']);
    $celular = trim($_POST['celular']);
    $secreta = trim($_POST['secreta']);
    $password = trim($_POST['password']);
    $rol = $_POST['rol'];
    $password2 = trim($_POST['password2']);
    
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    if (strlen($nombre) < 2) {
        $nuevoMensaje->formMensajeSistemaShow("El nombre debe tener como minimo 2 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
        <input name='btnRegistrar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
        </form>");
    } else {
        if (strlen($apaterno) < 4) {
            $nuevoMensaje->formMensajeSistemaShow("El Apellido Paterno debe tener como minimo 4 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
        <input name='btnRegistrar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
        </form>");
        } else {
            if (strlen($amaterno) < 4) {
                $nuevoMensaje->formMensajeSistemaShow("El Apellido Materno debe tener como minimo 4 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                <input name='btnRegistrar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                </form>");
            } else {
                if (strlen($username) < 4) {
                    $nuevoMensaje->formMensajeSistemaShow("El username debe tener como minimo 4 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                <input name='btnRegistrar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                </form>");
                } else {
                    if (strlen($dni) == 8) {
                        if (strlen($celular) == 9) {
                            if (strlen($password) < 4) {
                                $nuevoMensaje->formMensajeSistemaShow("La contraseña debe tener como minimo 4 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                        <input name='btnRegistrar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                        </form>");
                            } else {
                                if (strlen($secreta) < 2){
                                    $nuevoMensaje->formMensajeSistemaShow("La palabra secreta debe tener como minimo 2 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                                    <input name='btnRegistrar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                                    </form>");
                                }
                                else{
                                    if ($password == $password2) {
                                        
                                        $controlEditar = new controllerGestionarDatosUsuario;
                                        $controlEditar->agregarDatosUsuario($nombre, $apaterno, $amaterno, $username, $estado, $email, $dni, $celular, $secreta, $password, $rol);
                                    } else {
                                        $nuevoMensaje->formMensajeSistemaShow("Las dos contraseñas deben ser iguales", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                                         <input name='btnRegistrar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                                         </form>");
                                    }
                                }
                                
                            }
                        } else {
                            $nuevoMensaje->formMensajeSistemaShow("El celular debe tener 9", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
                    <input name='btnRegistrar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
                    </form>");
                        }
                    } else {
                        $nuevoMensaje->formMensajeSistemaShow("El DNI debe tener 8 digitos", "<form action='getGestionarUsuario.php' class='form-message__link' method='post' style='padding:0;'>
            <input name='btnRegistrar'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
            </form>");
                    }
                }
            }
        }
    }
}elseif(isset($_POST["btnContinuarNuevo"])){
    session_start();
    $nombre = trim($_POST['nombre']);
    $apaterno = trim($_POST['apaterno']);
    $amaterno = trim($_POST['amaterno']);
    $username = trim($_POST['username']);
    $estado = $_POST['estado'];
    $email = trim($_POST['email']);
    $dni = trim($_POST['dni']);
    $celular = trim($_POST['celular']);
    $secreta = trim($_POST['secreta']);
    $password = trim($_POST['password']);
    $rol = $_POST['rol'];
    $md5Password = md5($password);
    include_once("./controllerGestionarDatosUsuario.php");
    $objUsuario = new controllerGestionarDatosUsuario;
    $objUsuario-> agregarUsuario($nombre, $apaterno, $amaterno, $username, $estado, $email, $dni, $celular, $secreta, $md5Password, $rol);

}else {
    include_once("../shared/formMensajeSistema.php");
    $nuevoMensaje = new formMensajeSistema;
    $nuevoMensaje->formMensajeSistemaShow("¡ACCESO NO PERMITIDO!", "<a href='../index.php' class='form-message__link'>Volver</a>");
}

?>