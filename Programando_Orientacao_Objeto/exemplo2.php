<?php
// interpreta o documento xml
$xml = simplexml_load_file('paises.xml');

// imprime os atributos do objeto criado
echo '<p>Nome:      ' . $xml->nome       . '</p>';
echo '<p>Idioma:    ' . $xml->idioma     . '</p>';
echo '<p>Religiao:  ' . $xml->religiao   . '</p>';
echo '<p>Moeda:     ' . $xml->moeda      . '</p>';
echo '<p>População: ' . $xml->populacao  . '</p>';