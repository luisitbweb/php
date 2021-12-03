<?php
$ip = 3;
if ($ip % 2 == 0){
	echo 'O Numero e Par!';
}else {
	echo 'O Numero e Impar!';
}

echo '<hr>';

$pi = 2;
echo !($pi % 2)? "O Numero e Par!" : "O Numero e Impar!";

echo "<br /><br />---------------------------------Aula4---------------------------<br /><br />";

echo "<table style='border: 1px solid'>";

$Tarefa = ['Juliana' => ['Idade' => 34, 'Bairro' => 'Botafogo', 'Telefone' => 0192837465],
		
	  'Rafaela' => ['Idade' => 32, 'Bairro' => 'Tijuca', 'Telefone' => 0987654321],
		
	  'Beatriz' => ['Idade' => 31, 'Bairro' => 'Flamengo', 'Telefone' => 1234567890]];

foreach ($Tarefa as $nome => $valor){
    echo "<tr><th> $nome </th></tr>";
		foreach ($valor as $key => $dados){
			echo "<tr><td>$key</td></tr> <tr><td>$dados</td></tr>";
		}
}
echo "</table>";