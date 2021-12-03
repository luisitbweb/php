<?php

$var = 'Uma frase qualquer...';
  
switch($var){

	case is_bool($var):
		echo '$var é um tipo Boolean';
	break;
	
	case is_integer($var):  
		echo '$var é um tipo Integer';
	break;
	
	case is_string($var):
		echo '$var é um tipo String';
	break;
}
