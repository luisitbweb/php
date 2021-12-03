<?php

function soma($x, $y) {
	$x += $y;
	return $x;
}

$vetor = array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5);
$resultado = array_reduce($vetor, "soma");
echo "Juntando os elementos: $resultado.<hr/>";

if (array_key_exists("4", $vetor)) {
	echo "O elemento {$vetor['4']} está no array!";
}
