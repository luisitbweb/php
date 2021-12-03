<?php
// interpreta o documento xml
$xml = simplexml_load_file('paises.xml');

// exibe as informacoes do objeto criado
var_dump($xml);