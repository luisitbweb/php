<?php
 
function Taxar($valor, $quantidade){
	if ($quantidade < 10){
		$valor += $valor * 0.2;
	} else {
		$valor += $valor * 0.1;
    }
    return "Custo da compra: R$$valor.00";
}
   
$compra = Taxar(150.00, 10); 
echo $compra;