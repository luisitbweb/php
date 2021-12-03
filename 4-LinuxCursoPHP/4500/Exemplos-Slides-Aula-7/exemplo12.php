<?php

$num = 1;
echo "$num<br/>";
 
function adiciona(&$valor){
	$valor++;
}
 
$executa = adiciona($num);
echo $num;;