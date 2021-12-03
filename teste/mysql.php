<?php
 // configura a data para calculo

$day = 18;
$month = 9;
$year = 1972;

 // formata a data de nascimento como uma data iso 8601

$bdayISO = date ("c", mktime(0, 0, 0, $month, $day, $year));

 // usa a consulta mysql para calcular uma idade em dias

$db = mysqli_connect('localhost', 'root', 'mother');
$res = mysqli_query($db, "select datediff(now(), '$bdayISO')");
$age = mysqli_fetch_array($res);

  // converte a idade em dias para a idade em anos (aproximadamente)

echo "Age is ".floor($age[0]/365.25);
?>