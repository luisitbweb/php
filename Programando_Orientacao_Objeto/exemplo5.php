<?php
// interpreta o documento xml
$xml = simplexml_load_file('paises2.xml');

// alteracao de propriedades
$xml->populacao        = '220 milhoes';
$xml->religiao         = 'cristianismo';
$xml->geografia->clima = 'temperado';

// adiciona novo nodo
$xml->addChild('presidente', 'Chapolin Colorado');

// grava no arquivo paises2.xml
file_put_contents('paises2.xml', $xml->asXML());

// exibindo o novo xml
echo $xml->asXML();