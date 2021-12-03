<?php
function redirect($url){
    if (!headers_sent()){
        header('Location: ' . $url);
    }  else {
        die('Não foi possível redirecionar; Saída já foi enviado para o browser.');
    }
}