<?php
function manipulacao_erro($e_type, $e_message, $e_file, $e_line){
    /*
     * 
    echo '<h1>Oops!</h1>';
    echo '<p>Erros ocorreram durante a execução desta página. Contate o ' . '<a href="mailto:luisitb@ig.com.br">Administrador</a> para reportar ele.</p>';
    echo '<hr />';
    echo '<p><b>Tipos de erro:</p>' . $e_type . '<br />';
    echo '<b>Mensagens de erro:</b>' . $e_message . '<br />';
    echo '<b>Nome do arquivo:</b>' . $e_file . '<br />';
    echo '<b>Numeros de linhas:</b>' . $e_line . '</p>';
     * 
     */
    switch ($e_type){
        case E_ERROR:
            echo '<h1>Erro fatal:</h1>';
            echo '<p>Um erro fatal ocorreu em ' . $e_file . ' na linha ' . $e_line . '.<br />' . $e_message . '.</p>';
            die();
            break;
        case E_WARNING:
            echo '<h1>Aviso:</h1>';
            echo '<p>Um aviso ocorreu em ' . $e_file . ' na linha ' . $e_line . '.<br/>' . $e_message . '.';
            break;
        case E_NOTICE:
            // não mostrar erros de notificação
            break;
    }
}
// defina o erro manipulacao para ser usado
set_error_handler('manipulacao_erro');

// defina string com 'wrox' digitado errado
$string_variable = 'Worx livros são impressionante!';

// tente usar str_replace para substituir worx com wrox esse vai gerar um E_warning
// porque parametros de erros contam
str_replace('Worx', 'Wrox');