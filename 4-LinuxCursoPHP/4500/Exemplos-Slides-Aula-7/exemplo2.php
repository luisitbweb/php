<?php

function taxar($valor){
	$valor += $valor * 0.1;
	return $valor;
}
  
$preco = 25;
$juros = taxar($preco);
echo "O preço é $preco. Com juros é $juros";