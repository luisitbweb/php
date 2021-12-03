 <?php
   
$curso = '4500'; 
 
if ($curso == 4500 && $curso === 4500){
 	echo 'Idêntico.';
} elseif ($curso == 4500 && $curso !== 4500){
	echo 'Igual e não idêntico.';
} else {
	echo 'Diferente.';
  }