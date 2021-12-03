<?php
# carrega as classes

include_once 'Pessoa.class.php';
include_once 'Conta.class.php';
include_once 'ContaPoupanca.class.php';
include_once 'ContaCorrente.class.php';

// criacao do objeto $carlos
$carlos = new Pessoa(10, 'Carlos da silva', 1.85, 25, '10/04/1976', 'Ensino Medio', 650.00);
echo "Manipulando o objeto {$carlos->Nome}: <br />";

// criacao do objeto $conta_carlos
$contas[1] = new ContaCorrente(6677, 'CC.1234.56', '10/07/02', $carlos, 9876, 500.00, 200.00);
$contas[2]= new ContaPoupanca(6678, 'PP.1234.57', '10/07/02', $carlos, 9876, 500.00, '10/07');

// percorremos as contas
foreach ($contas as $key => $conta){
    echo "Manipulando a conta $key de: {$conta->Titular->Nome}: <br />";
    echo "O saldo atual da conta $key e R\$ {$conta->ObterSaldo()} <br />";
    $conta->Depositar(200);
    echo "O saldo atual da conta $key e R\$ {$conta->ObterSaldo()} <br />";
    $conta->Retirar(100);
    echo "O saldo atual da conta $key e R\$ {$conta->ObterSaldo()} <br />";
}