<?php
spl_autoload_register(function ($classe){
    //lista de diretórios para buscar as classes
    $diretorios = [
        'Libraries',
        'Helpers'
    ];
    //percorre os diretórios em busca das classes
    foreach($diretorios as $diretorio) {
        $arquivo = (__DIR__.DIRECTORY_SEPARATOR.$diretorio.DIRECTORY_SEPARATOR.$classe.'.php');
       //verifica se o arquivo de classe existe
        if(file_exists($arquivo)) {
            //inclui o arquivo de classe
            require_once $arquivo;
        }
    }

});