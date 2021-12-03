<?php

function Abrir($file = NULL) {
    if (!$file) {
        trigger_error('Falta o parametro com o nome do Arquivo', E_USER_NOTICE);
        return FALSE;
    }
    if (!file_exists($file)) {
        trigger_error('Arquivo não existente', E_USER_ERROR);
        return FALSE;
    }
    if (!$retorno = @file_get_contents($file)) {
        trigger_error('Impossivel ler o arquivo', E_USER_WARNING);
        return FALSE;
    }
    return $retorno;
}

// funcao para manipular o erro
function manipula_erro($numero, $mensagem, $arquivo, $linha) {
    $mensagem = "Arquivo $arquivo: linha $linha # Nº. $numero: $mensagem \n";

    // escreve no log todo tipo de erro
    $log = fopen('erros.log', 'a');
    fwrite($log, $mensagem);
    fclose($log);

    // se for uma warning
    if ($numero == E_USER_NOTICE) {
        echo $mensagem;
    } elseif ($numero == E_USER_WARNING) {
        echo $mensagem;
    } elseif ($numero == E_USER_ERROR) {
        // se for um erro fatal
        echo $mensagem;
        die;
    }
}

// define a funcao manipula_erro como manipuladora dos erros ocorridos
set_error_handler('manipula_erro');

// abrindo um arquivo
$arquivo = Abrir();
echo '<pre>' . $arquivo . '</pre>';
