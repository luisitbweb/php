<?php

for($contador = 1; $contador <= 10; $contador++) {
	if ($contador == 3) {continue;}
	$quadrado = $contador * $contador;
	echo "O quadrado de $contador é $quadrado<br />";
}