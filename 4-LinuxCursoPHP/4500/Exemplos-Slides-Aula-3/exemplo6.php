<?php
   
$prova1 = 5.2;
$prova2 = 6.5;
$prova3 = 8.2;
 
$avaliacao = (($prova1 + $prova2) / 2);  

if ($avaliacao >= 7.0 || $prova3 >= 7.0){
echo 'Aprovado.';
 } else {
 	echo "Reprovado.";
   }
