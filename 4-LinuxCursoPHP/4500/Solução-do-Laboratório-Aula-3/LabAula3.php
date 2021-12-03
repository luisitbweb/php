<?php

$num=3;

if ($num % 2 == 0){
	echo "Número par"; 
} else {
	echo "Número ímpar";
}

echo "<hr>";

switch ($num){
	case $num % 2 == 0:
		echo "Número par";
	break;
	case !$num % 2 == 0:
		echo "Número ímpar";
	break;
}