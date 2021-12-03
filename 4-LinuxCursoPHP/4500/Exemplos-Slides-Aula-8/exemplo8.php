<?php

$array = array(1, 2, 3, 4, 5);

function Cubo($num){
	return pow($num,3);
}

$cubo = array_map("Cubo",$array);

print_r($cubo);

echo '<hr/>';

print_r(array_chunk($cubo, 3));