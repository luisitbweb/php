<?php
function Abrir($file = NULL){
    if (!$file){
        throw new Exception('Falta o parametro com nome do arquivo!');
    }
    if (!file_exists($file)){
        throw new Exception('Arquivo não existente!');
    }
    if (!$retorno = @file_get_contents($file)){
        throw new Exception('Impossivel ler o arquivo!');
    }
    return $retorno;
}

/*
 * abrindo um arquivo
 * tratamento de excecoes
 */

try {
    $arquivo = Abrir();
    echo '<pre>' . $arquivo . '</pre>';
} catch (Exception $excecao) {
    // captura o erro
    echo $excecao->getFile() . ' &DoubleLeftRightArrow; ' . $excecao->getLine() . ' # ' . $excecao->getMessage();
}