<!DOCTYPE html>

<html>

	<head>

		<meta charset="UTF=8"/>

		<title>Formulario</title>

	</head>

		<body>
			<div>

				<?php 
					$nome = isset($_GET["n"]) ? $_GET["n"] : "[Não informado]";
					$ano = isset($_GET["a"]) ? $_GET["a"] : "[Não informado]";
					$sexo = isset($_GET["s"]) ? $_GET["s"] : "[Sem Sexo]";
					$idade = date("Y") - $ano;
			
					echo " $nome e $sexo e tem $idade anos. ";
			
				?>

					<br/><br/><a href="formulario.html">Voltar</a>

			</div>
		</body>

</html>