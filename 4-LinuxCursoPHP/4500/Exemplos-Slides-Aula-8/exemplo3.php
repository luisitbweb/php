<?php

$matriz = array (1, 2, array ("a", "b", "c"));
var_export($matriz);
echo '<hr/>';

function criaArray($contagem, $numero){
	while ($contagem <= $numero){
		$vetor[] = $contagem;
		$contagem++;
	}
	return $vetor;
}
$retorno = criaArray(1, 10);
print_r($retorno);