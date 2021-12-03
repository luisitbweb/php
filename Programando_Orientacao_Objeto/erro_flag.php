<?php

function Abrir($file = NULL) {
    if (!$file) {
        return FALSE;
    }
    if (!file_exists($file)) {
        return FALSE;
    }
    if (!$retorno = @file_get_contents($file)) {
        return FALSE;
    }
    return $retorno;
}

$arquivo = Abrir('readme.txt');

// verifica se abriu o arquivo
if (!$arquivo) {
    echo 'Falha ao abrir o arquivo';
} else {
    echo '<pre>' . $arquivo . '</pre>';
}