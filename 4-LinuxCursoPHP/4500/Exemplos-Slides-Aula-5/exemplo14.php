<?php

for($contador = 100; $contador >= 1; $contador--) {
	if ($contador % 2 == 0) {continue;}
	echo $contador.'<br/>';
}