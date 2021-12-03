<?php

$vetor1 = array('1', '2', '3');
$vetor2 = array('um', 'dois', 'três');

$vetor3 = array_combine($vetor1, $vetor2);
print_r($vetor3);
echo '<hr/>';

$resultado = array_merge($vetor1, $vetor2);
print_r($resultado);
echo '<hr/>';

$vetor3 = array_fill(1, 3, 'Sobrescrita');
print_r($vetor3);