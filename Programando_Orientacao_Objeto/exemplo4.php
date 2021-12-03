<?php
// interpreta o documento xml
$xml = simplexml_load_file('paises2.xml');

echo '<p>Nome  : ' . $xml->nome   . '</p>';
echo '<p>Idioma: ' . $xml->idioma . '</p>';

echo "<br />";

echo "&star;&star;&star; Informações Geográficas &star;&star;&star;<br />";

echo '<p>Clima : ' . $xml->geografia->clima . '</p>';
echo '<p>Costa : ' . $xml->geografia->costa . '</p>';
echo '<p>Pico  : ' . $xml->geografia->pico  . '</p>';