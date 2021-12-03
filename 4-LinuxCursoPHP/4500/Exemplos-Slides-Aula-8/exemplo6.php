<?php

$resposta = 'A resposta é';
$numero = 3 * pow(10,42);
$numero = (string) $numero;
$fim = 42;

$formato = "<p> %s %s que não é igual a %d. </p>";
printf($formato, $resposta, $numero, $fim);

$mem = sprintf($formato, $resposta, $numero, $fim);
echo $mem;