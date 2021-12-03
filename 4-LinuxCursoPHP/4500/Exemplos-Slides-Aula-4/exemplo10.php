<?php

$semestres = array(
    'primeiro' => array(
        'nota1' => 8.5,
        'nota2' => 7.2),
    'segundo' => array(
        'nota1' => 7.1,
        'nota2' => 9.6)
);

echo "A 2<sup>a</sup> nota do primeiro semestre foi de {$semestres['primeiro']['nota2']}";
