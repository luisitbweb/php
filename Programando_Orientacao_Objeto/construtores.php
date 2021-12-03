<?php
// carrega as classes
include_once 'Pessoa.class.php';
include_once 'Conta.class.php';

// criacao do objeto $carlos

$carlos = new Pessoa(10, 'Carlos da silva', 1.85, 25, '10/04/1976', 'Ensino Medio', 650.00);

echo "Manipulando o objeto {$carlos->Nome}: <br />";
echo "{$carlos->Nome} e formado em: {$carlos->Escolaridade} <br />";
$carlos->Formar('tecnico em eletronica');
echo "{$carlos->Nome} e formado em: {$carlos->Escolaridade} <br />";

echo "{$carlos->Nome} possui {$carlos->Idade} anos <br />";
$carlos->Envelhecer(1);
echo "{$carlos->Nome} possui {$carlos->Idade} anos <br />";

// criacao do objeto $conta_carlos
$conta_carlos = new Conta(6677, 'CC.1234.56', '10/07/02', $carlos, 9876, 567.89);

echo "<br />";

echo "Manipulando a conta de: {$conta_carlos->Titular->Nome}: <br />";

echo "O saldo atual e R\$ {$conta_carlos->ObterSaldo()} <br />";
$conta_carlos->Depositar(20);
echo "O saldo atual e R\$ {$conta_carlos->ObterSaldo()} <br />";
$conta_carlos->Retirar(10);
echo "O saldo atual e R\$ {$conta_carlos->ObterSaldo()} <br />";