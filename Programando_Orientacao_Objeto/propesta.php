<?php
class Aplicacao{
    static $Quantidade;
    
    /*
     * metodo construtor
     * incrementa a $quantidade de aplicacoes
     */
    
    function __construct($Nome) {
        // incrementa propriedade estatica
        self::$Quantidade ++;
        $i = self::$Quantidade;
        echo "Nova Aplicação nr. $i: $Nome<br>";
    }
}

// cria novos objetos
new Aplicacao('Dia');
new Aplicacao('Gimp');
new Aplicacao('Gnumeric');
new Aplicacao('Abiword');
new Aplicacao('Evolution');

echo 'Quantidade de Aplicações = ' . Aplicacao::$Quantidade . '.<br>';