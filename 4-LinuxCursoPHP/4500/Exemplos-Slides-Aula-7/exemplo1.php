<?php
   
function Enfase($valor){
	$valor = "<em>$valor</em>";
	return $valor;
 }
 $retorno = Enfase("Olá mundo! ");
 echo $retorno;