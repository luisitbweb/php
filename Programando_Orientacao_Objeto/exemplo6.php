<?php
// interpreta o documento xml
$xml = simplexml_load_file('paises3.xml');

echo '<p>Pais   : ' . $xml->nome   . '</p>';
echo '<p>Idioma : ' . $xml->idioma . '</p>';

echo '<br />';

echo "&star;&star;&star; Estados &star;&star;&star;";

/*
 * voce pode acessar um estado diretamente pelo seu indice
 * echo $xml->estados->nome[0];
 */

foreach ($xml->estados->nome as $estado){
    echo '<p>Estado: ' . $estado . '</p>';
}