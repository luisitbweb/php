<?php
// interpreta o documento xml
$xml = simplexml_load_file('paises4.xml');

echo "&star;&star;&star; Estados &star;&star;&star;<br />";

// percorre os estados
foreach ($xml->estados->estado as $estado){
    // percorre os atributos de cada estado
    foreach ($estado->attributes() as $key => $value){
        echo "$key=>$value<br />";
    }
}