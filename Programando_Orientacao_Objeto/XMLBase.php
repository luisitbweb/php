<?php
// inclue classe xmlbase
include_once './XMLBase.class.php';

class Cachorro extends XMLBase{
    // metodo construtor
    function __construct($nome, $idade, $raca) {
        $this->nome  = $nome;
        $this->idade = $idade;
        $this->raca  = $raca;
    }
}

$toto = new Cachorro('Toto', 10, 'Fox Terrier');
$vava = new Cachorro('Daba', 8, 'Dalmata');
echo $toto->toXml();
echo $vava->toXml();