<?php
function Abrir($file = NULL){
    if (!$file){
        die('Falta de parametro com o nome do Arquivo');
    }
    if (!file_exists($file)){
        die('Arquivo não existente');
    }
    if (!$retorno = @file_get_contents($file)){
        die('Impossivel ler o arquivo');
    }
    return $retorno;
}
// abrindo um arquivo
$arquivo = Abrir('readme.txt');
echo '<pre>' . $arquivo . '</pre>';