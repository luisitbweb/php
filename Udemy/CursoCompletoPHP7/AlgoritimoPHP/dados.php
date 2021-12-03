<!DOCTYPE html>

<html>

	<head>

		<meta charset="UTF=8"/>

		<title>Calculo</title>

	</head>

<body>
	<div>

		<?php 
			$valor = $_GET['n'];
			$rq = sqrt($valor);
			
			echo "<br/> A Raiz de $valor e: ".number_format($rq,2);
			
		?>

		<br/><br/><a href="dados.html">Voltar</a>

	</div>
</body>

</html>