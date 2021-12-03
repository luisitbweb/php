<?php
require 'exemplo3.php';

$conta3 = new Conta();
$conta3->Depositar(500);
$conta3->Sacar(2000);
$conta3->verSaldo();

echo '<hr>';

$conta4 = new Conta();
$conta4->Depositar(3500);
$conta4->verSaldo();
$conta4->Sacar(475);
$conta4->verSaldo();