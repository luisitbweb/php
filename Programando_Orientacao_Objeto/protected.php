<?php
# carrega as classes
include_once 'Funcionario.class.php';
include_once 'Estagiario.class.php';

$pedrinho = new Estagiario();
$pedrinho->SetSalario(248);
echo 'O salario de Pedrinho e R$:' . $pedrinho->GetSalario() . "\n";