<?php
// interpreta o documento xml
$xml = simplexml_load_file('paises4.xml');

echo "&star;&star;&star; Estados &star;&star;&star;<br />";
// percorre a lista de estados
foreach ($xml->estados->estado as $estado){
    // imprime o estado e a capital
    echo str_pad('<p>Estado: ' . $estado['nome'], 30) . 'Capital: ' . $estado['capital'] . '</p>';
}