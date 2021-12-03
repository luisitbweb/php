<?php

function impar($variavel){
    return($variavel & 1);
}

function par($variavel){
	return(!($variavel & 1));
}

$vetor = array(6,7,8,9,10,11,12);
echo "Busca ímpares: \n";
print_r(array_filter($vetor, "impar"));
echo '<hr>';
echo "Busca pares: \n";
print_r(array_filter($vetor, "par"));