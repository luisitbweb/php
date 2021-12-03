<?php
class Cachorro{
    private $Nascimento;
    
    // metodo construtor
    function __construct($nome) {
        $this->nome = $nome;
    }
    
    // tostring executado sempre que o objeto for impresso
    function __toString() {
        return $this->nome;
    }
}

$toto = new Cachorro('Toto');
$vava = new Cachorro('Daba');

echo $toto;
echo '<br />';
echo $vava;
echo '<br />';