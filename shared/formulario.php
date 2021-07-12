<?php 

class formulario {
    protected function encabezadoShowIni($titulo){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./public/styles.css">
            <title><?php echo $titulo?></title>
        </head>
        <body>
        <?php
    }
    protected function encabezadoShow($titulo){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./public/styles.css">
            <title><?php echo $titulo?></title>
        </head>
        <body>
        <?php 
    }
    protected function piePaginaShow(){
        ?>  
        </body>
        </html>
        <?php 
    }

}

?>