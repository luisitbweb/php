<?php

$sem = array(
    'Primeiro' => array(
        'Prova 1' => 8.5,
        'Prova 2' => 7.2),
    'Segundo' => array(
        'Prova 1' => 7.1,
        'Prova 2' => 9.6)
);

foreach ($sem as $chave => $valor) {
    echo "<h3>$chave semestre:</h3><br/>";
    foreach ($valor as $prova => $notas) {
        echo "$prova : <b>$notas</b><br />";
    }
}