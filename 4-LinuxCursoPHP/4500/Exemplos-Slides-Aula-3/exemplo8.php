<?php
  
$nota = 7.0; 
$prese = 65;   

if ($nota >= 7.0 && $prese >= 65){
	echo 'Aprovado.';
} elseif ($nota < 7.0 && $presenca >= 65){
	echo 'Recuperação: Nota abaixo da média.';
} elseif ($nota >= 7.0 && $presenca < 65){
	echo 'Recuperação: Ausência em aulas.';
} else {
	echo 'Reprovado';
  }