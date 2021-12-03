<?php
# carrega a classe
include_once './Funcionario.class.php';

// instancia novo funcionario
$pedro = new Funcionario();

// atribui novo salario
$pedro->SetSalario(876);

// obtem o salario
echo "Salario: R\$ {$pedro->GetSalario()}";