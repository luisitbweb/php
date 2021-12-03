<?php

$saldo = 500;
function saque($valor){
	global $saldo;
	if ($saldo >= $valor){
		$saldo -= $valor;
		echo "Saque executado. Saldo atual $saldo";
	} else {
		echo "Saldo insuficiente!";
	}
}

$sacar = saque(350);
echo $sacar;