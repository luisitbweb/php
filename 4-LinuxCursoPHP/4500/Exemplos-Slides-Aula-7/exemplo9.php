<?php

function criaArray($contagem, $numero){
	while ($contagem <= $numero){
		$vetor[] = $contagem;
		$contagem++;
	}
    return $vetor;
}

$retorno = criaArray(1, 10);
var_dump($retorno);