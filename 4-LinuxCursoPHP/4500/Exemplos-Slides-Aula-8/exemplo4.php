<?php

$frase = "Função, Nativa, explode, PHP";
 
$explodir = explode(',',$frase);
echo 'Explodindo a string em array: ';
print_r($explodir);

$implodir = implode(",", $explodir);
echo '<p>Implodindo o array em string: '.
substr_replace($implodir,'implode',-12,-4).'</p>';