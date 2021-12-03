<?php

$temperaturas = array(
    '2008' => array(
        'Janeiro' => 30,
        'Fevereiro' => 32,
        'Março' => 29),
    '2009' => array(
        'Janeiro' => 31,
        'Fevereiro' => 34,
        'Março' => 30),
    '2010' => array(
        'Janeiro' => 32,
        'Fevereiro' => 34,
        'Março' => 28)
);

echo "Janeiro de 2008 foi de: {$temperaturas['2008']['Janeiro']} graus";
