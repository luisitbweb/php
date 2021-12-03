<?php

$arquivo = 'exemplo5.txt';
$texto = file_get_contents($arquivo);

echo $texto.'<hr/>';

$original = nl2br($texto);

echo $original;