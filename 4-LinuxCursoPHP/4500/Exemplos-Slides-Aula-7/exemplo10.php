<?php
 
$percent = 0.5;

function fift($valor) {
	global $percent;
	$valor *= $percent;
	return $valor ;
}

$quant = 33;
$calc = fift($quant);
echo "50% de $quant é $calc";