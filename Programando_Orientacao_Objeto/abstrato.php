<?php
include_once './Pessoa.class.php';
include_once './abstractConta.class.php';
include_once './ContaPoupanca.class.php';

$carlos = new Pessoa(10, 'Carlos da silva', 1.85, 25, 72, 'Ensino Medio', 650.00);
$conta = new ContaPoupanca(6677, 'CC.1234.56', '10/07/02', $carlos, 9876, 500.00, '10/07');