<?php
class Cachorro{
    // metodo construtor
    function __construct($nome, $idade, $raca) {
        $this->nome  = $nome;
        $this->idade = $idade;
        $this->raca  = $raca;
    }
    // toXml retorna o objeto no formato xml
    function toXml(){
        return
        <<<XML
        <p><cachorro>
            <nome> {$this->nome} </nome>
            <idade> {$this->idade} </idade>
            <raca> {$this->raca} </raca>
        </cachorro></p>
XML;
    }
}

$toto = new Cachorro('Toto', 10, 'Fox Terrier');
$vava = new Cachorro('Daba', 8, 'Dalmata');
echo $toto->toXml();
echo $vava->toXml();