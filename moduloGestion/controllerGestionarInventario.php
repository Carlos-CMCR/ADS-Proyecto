<?php
class controllerGestionarInventario
{
    public function obtenerProductos()
    {
        include_once "../model/FactoryModels.php";
        $objProducto = FactoryModels::getModel("producto");
        $arrayProductos = $objProducto->ListaDeProductos();
        //var_dump($arrayProductos);
        include_once "formListaDeProductos.php";
        if (!isset($_SESSION)) {
            session_start();
        }
        $objListaProductos = new formListaDeProductos($_SESSION["informacion"]);
        $objListaProductos->formListaDeProductosShow($arrayProductos);
    }
    public function buscarProducto($productos)
    {
        include_once "../model/FactoryModels.php";
        $objProducto = FactoryModels::getModel("producto");
        $arrayProductos = $objProducto->obtenerProductosB($productos);

        include_once "formListaDeProductos.php";
        session_start();
        $objListaProductos = new formListaDeProductos($_SESSION["informacion"]);
        $objListaProductos->formListaDeProductosShow($arrayProductos, false, $productos);
    }
    //Paranuevoproducto
    public function obtenerOpcionProducto()
    {
        include_once "../model/FactoryModels.php";
        $objObservaciones = FactoryModels::getModel("observacion");
        $objCategorias = FactoryModels::getModel("categoria");
        $objMarcas = FactoryModels::getModel("marca");
        $objEstados = FactoryModels::getModel("estado_entidad");

        $observaciones = $objObservaciones->listarObservaciones();
        $categorias = $objCategorias->listarCategorias();
        $marcas = $objMarcas->listarMarcas();
        $estados = $objEstados->listarEstadoEntidad();

        include_once "formNuevoProducto.php";
        session_start();
        $form = new formNuevoProducto($_SESSION["informacion"]);
        $form->formNuevoProductoShow($observaciones, $categorias, $marcas, $estados);
    }

    public function agregarNuevoProducto($codigo_producto, $nombre, $stock, $precioUnitario, $descripcion, $id_categoria, $id_marca, $id_observacion, $id_estadoEntidad)
    {
        session_start();
        include_once "../model/FactoryModels.php";
        $objDatosProducto = FactoryModels::getModel("producto");
        $consulta = $objDatosProducto->validarSiExiteCodigoProducto($codigo_producto);

        if ($consulta["existe"]) {
            include_once "../shared/formMensajeSistema.php";
            $nuevoMensaje = new formMensajeSistema;
            $nuevoMensaje->formMensajeSistemaShow(
                $consulta["mensaje"],
                "<form action='getGestionarInventario.php' class='form-message__link' method='post' style='padding:0;'>
                <input name='btnNuevo'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
            </form>");
        } else {
            $respuesta = $objDatosProducto->insertarNuevoProducto($codigo_producto, $nombre, $stock, $precioUnitario, $descripcion, $id_categoria, $id_marca, $id_observacion, $id_estadoEntidad);
            if ($respuesta["success"]) {
                include_once "../shared/formMensajeSistema.php";
                $nuevoMensaje = new formMensajeSistema;
                $nuevoMensaje->formMensajeSistemaShow(
                    "Se agrego el producto con exito",
                    "<form action='getGestionarInventario.php' class='form-message__link' method='post' style='padding:0;'>
                    <input name='btnGestionarInventario'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                </form>", true);
            } else {
                include_once "../shared/formMensajeSistema.php";
                $nuevoMensaje = new formMensajeSistema;
                $nuevoMensaje->formMensajeSistemaShow(
                    "Ocurrió un error en la base de datos, comuníquese con el administrador",
                    "<form action='getGestionarInventario.php' class='form-message__link' method='post' style='padding:0;'>
                    <input name='btnNuevo'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
                </form>");

            }
        }

    }

    public function obtenerDatosProducto($id_producto){
        include_once "../model/FactoryModels.php";

        $objDatosProducto = FactoryModels::getModel("producto");
        $objObservaciones = FactoryModels::getModel("observacion");
        $objCategorias = FactoryModels::getModel("categoria"); 
        $objMarcas = FactoryModels::getModel("marca");; 
        $objEstados = FactoryModels::getModel("estado_entidad"); 

        $arrayDatosProducto=  $objDatosProducto->obtenerDatosProducto($id_producto);
        $observaciones = $objObservaciones->listarObservaciones();
        $categorias = $objCategorias->listarCategorias();
        $marcas = $objMarcas->listarMarcas();
        $estados = $objEstados->listarEstadoEntidad();
       
        include_once("formModificarProducto.php");
        session_start();
        $form = new formModificarProducto($_SESSION["informacion"]);
        $form->formModificarProductoShow($arrayDatosProducto,$observaciones,$categorias,$marcas,$estados);
    }

    public function actualizarProducto($id_producto,$nombre,$stock,$precioUnitario,$descripcion,$id_categoria,$id_marca,$id_observacion ,$id_estadoEntidad){
        session_start();
        include_once "../model/FactoryModels.php";
        $objDatosProducto = FactoryModels::getModel("producto");
        $respuesta = $objDatosProducto ->modificarProducto($id_producto,$nombre,$stock,$precioUnitario,$descripcion,$id_categoria,$id_marca,$id_observacion,$id_estadoEntidad);
       // $arrayProductos = $objDatosProducto ->obtenerProductosConObservaciones();
        if($respuesta["success"]){
            include_once("../shared/formMensajeSistema.php");
             $nuevoMensaje = new formMensajeSistema;
             $nuevoMensaje -> formMensajeSistemaShow(
            "Se actualizo el producto con exito",
            "<form action='getGestionarInventario.php' class='form-message__link' method='post' style='padding:0;'>
                <input type='hidden' name='idProducto'  value='$id_producto' />
                <input name='btnGestionarInventario'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
            </form>", true);
        }else{
            include_once("../shared/formMensajeSistema.php");
             $nuevoMensaje = new formMensajeSistema;
             $nuevoMensaje -> formMensajeSistemaShow(
            "Ocurrió un error en la base de datos, comuníquese con el administrador
            ",
            "<form action='getGestionarInventario.php' class='form-message__link' method='post' style='padding:0;'>
                <input name='btnGestionarInventario'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='volver' type='submit'>
            </form>");
        }
        		
    }
}
