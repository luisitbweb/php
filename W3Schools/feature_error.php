<?php

// criando sua funcao de manipulacao de erro
function my_error_handler($e_type, $e_message, $e_file, $e_line) {
    $msg = 'Erros ocorreram durante a execução de uma página.' . "\n\n";
    $msg .= 'Tipo erro: ' . $e_type . "\n";
    $msg .= 'Mensagem de erro: ' . $e_message . "\n";
    $msg .= 'Nome arquivo: ' . $e_file . "\n";
    $msg .= 'Numero linha: ' . $e_number . "\n";
    $msg = wordwrap($msg, 75);

    switch ($error_type) {
        case E_ERROR:
            mail('luisitb@ig.com.br', $msg, 'Faltal erro em website');
            die();
            break;
        case E_WARNING:
            mail('luisitb@ig.com.br', $msg, 'Aviso de website');
            break;
    }
}
// defina manipulacao de erro para 0 porque nos vamos manipular todos os relatorios de erro e notificar o administrador avisos de erros fatais
error_reporting(0);

// defina o erro manuseio para ser usado
set_error_handler('my_error_handler');

// criar o resto de sua pagina aki.