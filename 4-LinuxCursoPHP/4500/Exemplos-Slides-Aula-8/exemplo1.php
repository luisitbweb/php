<?php

$var = array();

if(isset($var)){
	echo 'A variável foi declarada.<br/>';
}

if(empty($var)){
	echo 'A variável declarada esta vazia.<br/>';
}

$tipagem = settype($var, bool);
$tipo = gettype($var);

echo "A variável agora é do tipo $tipo";