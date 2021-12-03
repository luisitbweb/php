<?php

$obj_aula5 = new DOMDocument('1.0', 'UTF-8');
$obj_aula5->load('cursos.xml');

$obj_aula5->createAttribute('capitolo01');
$obj_aula5->createTextNode('sdfsdf');
?>

