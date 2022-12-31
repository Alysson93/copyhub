<?php
session_start();

include './../app/configuracao.php';
include './../app/autoload.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;1,700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=URL?>/public/css/comum.css">

</head>
<body>

    <?php
        include '../app/Views/header.php';
        $rotas = new Rota();
        include '../app/Views/footer.php';
    ?>

    
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>    
    <script src="<?=URL?>/public/js/header.js"></script> 
    <script src="<?=URL?>/public/js/slider.js"></script> 
</body>
