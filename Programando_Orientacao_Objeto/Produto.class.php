<?php

class Produto {

    var $Codigo;
    var $Descricao;
    private $Preco;
    var $Quantidade;
    var $Fornecedor;

    const MARGEM = 10;

    // metodo construtor de um produto
    function __construct($Codigo, $Descricao, $Quantidade, $Preco) {

        $this->Codigo = $Codigo;
        $this->Descricao = $Descricao;
        $this->Quantidade = $Quantidade;
        $this->Preco = $Preco;
    }

    // intercepta a obtencao de propriedades
    function __get($propriedade) {

        echo "Obtendo o valor de $propriedade: {$this->Descricao}<br />";
        if ($propriedade == 'Preco') {
            return $this->$propriedade * (1 + (self::MARGEM / 100));
        }
    }

    // intercepta a chamada a metodos
    function __call($metodo, $parametro) {
        echo "Você executou o metodo: {$metodo}<br />";
        foreach ($parametro as $key => $parametro) {
            echo "\t Parâmetro $key: Tem $parametro Itens. <br />";
        }
    }

}
