<?php

$temperaturas = array(
		             'Janeiro' => 30,
		             'Fevereiro' => 32, 
 		             'Março' => 29
                     );
 
foreach ($temperaturas as $chave => $valor) {
	echo "A temperatura média de $chave foi de $valor graus<hr/>";
}