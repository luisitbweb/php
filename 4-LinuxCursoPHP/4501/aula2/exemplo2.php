<?php
require 'exemplo1.php';

$conta1 = new Conta();
$conta1->Depositar(500);
$conta1->Sacar(200);
$conta1->verSaldo();

echo '<hr>';

$conta2 = new Conta();
$conta2->Depositar(350);
$conta2->verSaldo();