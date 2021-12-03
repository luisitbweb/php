<?php
function Abrir($file = NULL){
    if(!$file){
        throw new ParameterException('Falta o parametro com o nome do arquivo!');
    }
    if (!file_exists($file)){
        throw new FileNotFoundException('Arquivo não existente!');
    }
    if (!$retorno = @file_get_contents($file)){
        throw new FilePermissionException('Impossivel ler o arquivo!');
    }
    return $retorno;
}

// definicao das subclasses de erro
class ParameterException extends Exception{}
class FileNotFoundException extends Exception{}
class FilePermissionException extends Exception{}

/*
 * abrindo um arquivo
 * tratamento de excecoes
 */

try {
    $arquivo = Abrir('');
    echo '<pre>' . $arquivo . '</pre>';
} catch (ParameterException $excecao) {
    // captura o erro
    echo $excecao->getFile() . ' &DoubleLeftRightArrow; ' . $excecao->getLine() . ' # ' . $excecao->getMessage() . " Finalizando aplicação... \n";
}catch (FileNotFoundException $excecao){
    var_dump($excecao->getTrace());
    echo $excecao->getFile() . ' &DoubleLeftRightArrow; ' . $excecao->getLine() . ' # ' . $excecao->getMessage() . " Finalizando aplicação... \n";
    die();
}catch (FilePermissionException $excecao){
    echo $excecao->getFile() . ' &DoubleLeftRightArrow; ' . $excecao->getLine() . ' # ' . $excecao->getMessage() . " Finalizando aplicação... \n";
}