<?php
 
function Fat($valor){

	if($valor == 0){
		return ++$valor;
	} elseif ($valor == 1){
		return $valor;
	} elseif ($valor > 1){
		return $valor * Fat($valor - 1);
	} else {
		return "Somente números positivos.";
	}
}

$retorno = Fat(5);
echo $retorno;