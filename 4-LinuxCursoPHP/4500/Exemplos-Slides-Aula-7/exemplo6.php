<?php
 
function result($prova, $pontos){
	$prova += $pontos;
   	return $prova;
}

$nota = 6.2;
$media = result($nota, 0.7);

echo "Sua média foi: $media";