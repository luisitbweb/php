<?php
 // configura a data para calculo

$day = 18;
$month = 9;
$year = 1972;

 // lembre-se de que voce precisa de bday como dia mes e ano

$bdayunix = mktime ('', '', '', $month, $day, $year);

 // obtem ts unix para bday

$nowunix = time();  // obtem ts unix para hoje
$ageunix = $nowunix - $bdayunix; // acha a diferença
$age = floor($ageunix / (365*24*60*60)); //converte de segundos para anos

echo "Age is $age";
?>