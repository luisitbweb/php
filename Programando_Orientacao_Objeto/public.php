<?php
# carrega as classes
include_once './Funcionario.class.php';
include_once './Estagiario.class.php';

// cria objeto funcionario
$pedrinho = new Funcionario();
$pedrinho->Nome = 'Pedrinho';

// cria objeto estagiario
$mariana = new Estagiario();
$mariana->Nome = 'Mariana';

// imprime propriedade nome
echo $mariana->Nome . "<br />";
echo $pedrinho->Nome;