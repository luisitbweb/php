<?php
// interpreta o documento xml
$xml = simplexml_load_file('paises.xml');

foreach ($xml->children() as $elemento => $valor){
    echo "$elemento &DoubleRightArrow; $valor <br />";
}