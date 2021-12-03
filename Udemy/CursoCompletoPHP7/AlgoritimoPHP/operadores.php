<!DOCTYPE html>

<html>

	<head>

		<meta charset="UTF=8"/>

		<title>Operadores</title>

	</head>

<body>
	<div>

		<?php 

			$n1 = $_GET['a'];
			$n2 = $_GET['b']; 
			$tipo = $_GET['op'];
			
			echo "Os valores passados foram $n1 e $n2:<br/><br/>";
				$r = ($tipo == "S") ? $n1+$n2 : $n1*$n2;
			echo " O resultado e: $r";
			
		?>

		<br/><br/><a href="operadores.html">Voltar</a>

	</div>
</body>

</html>