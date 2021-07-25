<?php 
require_once __DIR__ ."/../shared/footerSingleton.php";
require_once __DIR__ ."/../shared/headSingleton.php";
class formAgregarCliente {
    public function formAgregarClienteShow($informacion,$cliente = []){
        headSingleton::getHead("Formulario Agregar Cliente",$informacion,"..");
        ?>
        <div class="wrapper-actions" style="width:40%">
            <h1>Formulario Agregar Cliente</h1>
            <form style="display:flex;gap:10px;width: 100%;justify-content: center; height:30px;align-items: center;">
                <p>DNI</p>
                <input type="text" name="" id="">
                <button>Buscar</button>
            </form>
        <?php 
            if(count($cliente)){
                
            }
        
        ?>

        <form action="" style="display:flex;flex-wrap: wrap;width: 100%;gap:10px">
            <input type="text" name="" id="" placeholder="DNI" style="width: calc(50% - 10px);">
            <input type="text" name="" id="" placeholder="Apellido Paterno" style="width: calc(50% - 10px);">
            <input type="text" name="" id="" placeholder="Apellido Materno" style="width: calc(50% - 10px);">
            <input type="text" name="" id="" placeholder="Celular" style="width: calc(50% - 10px);">
            <input type="text" name="" id="" placeholder="Nombres" style="width: calc(50% - 10px);">
            <input type="text" name="" id="" placeholder="Email" style="width: calc(50% - 10px);">
            <button type="submit" class='form-message__link' style='width:100%;font-size:1.5em;padding:.8rem;background-color: green;'>Emitir</button>
        </form>
        <div class="lista-form" style="display:flex;width: 100%;gap:50px">
            <form action='getEmitirProforma.php' class='form-message__link' style="width:100%;" method='post' style='padding:0;'>
                <input name='btnVerLista'  class='form-message__link' style='width:100%;font-size:1.5em;padding:0;' value='Volver' type='submit'>
            </form>
            <!-- <form action='getEmitirProforma.php'  method='post' style='padding:0;'>
                <input name='btnAgregarCliente'  class='verde-form__button' style='width:100%;font-size:1.5em;padding:.5em;' value='Generar Proforma' type='submit'>
            </form> -->
        </div>
        </div>
        <?php
        footerSingleton::getFooter(".."); 
    }
}

?>