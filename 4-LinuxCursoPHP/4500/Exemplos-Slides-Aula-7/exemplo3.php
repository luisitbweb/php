<?php
   
function Negrito($valor){
	$valor = "<strong>$valor</strong>";
	return $valor;
}
   
$retorno = Negrito('Olá mundo, novamente!');
  
function quebraLinha(){
	return '<br/>';
}

echo $retorno.quebraLinha().$retorno;