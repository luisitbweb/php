<?php

function hostname(){
	$hostname = `hostname`;
	return $hostname;
}

$servidor = hostname();
var_dump(is_callable($servidor, TRUE, $nome));
echo $nome.'<hr/>';
unset($servidor);

$matriz = array (1, 2, array ("a", "b", "c"));
var_dump($matriz);