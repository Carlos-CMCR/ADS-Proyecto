<?php 

require_once __DIR__ ."/../shared/footerSingleton.php";
require_once __DIR__ ."/../shared/headSingleton.php";

class formVerLista {
    public function formVerListaShow($informacion){
        headSingleton::getHead("Formulario ver Lista",$informacion,"..");
        ?>
        <main class='wrapper-actions'>
        <div class="lista-form" style="display:flex;width: 100%;gap:50px">
            <form action='getEmitirProforma.php' class='form-message__link' method='post' style='padding:0;'>
                <input type='hidden' name='regresar' />
                <input name='btnEmitirProforma'  class='form-message__link' style='width:100%;font-size:1.5em;padding:.5em;' value='Volver' type='submit'>
            </form>
        </div>
        
        </main>
        <?php
        var_dump($_SESSION["lista_proforma"]);
        footerSingleton::getFooter("..");
    }
}

?>