<?php
 
function venda($valor, $quant = 1){
	$valor *= $quant;
	return $valor;
}
 
$preco = 80;
$compra = venda($preco);
  
echo "Você gastou $compra";