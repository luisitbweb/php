<?php

/*
 * class produto
 * representa um produto a ser vendido
 */

final class Produto {

    static $recordset = array(); // representa estrutura de dados

    /*
     * metodo adicionar
     * adicionar um produto ao registro
     * @param $descricao = descricao do produto
     * @param $estoque = estoque atual
     * @param $preco_custo = preco de custo
     */

    public function adicionar($id, $descricao, $estoque, $preco_custo) {
        self::$recordset[$id]['descricao'] = $descricao;
        self::$recordset[$id]['estoque'] = $estoque;
        self::$recordset[$id]['preco_custo'] = $preco_custo;
    }

    /*
     * metodo registracompra
     * registra uma compra atualiza custo e incrementa o estoque atual do produto
     * @param $unidade = unidades adquiridas
     * @param $preco_custo = novo preco de custo
     */

    public function registraCompra($id, $unidades, $preco_custo) {
        self::$recordset[$id]['preco_custo'] = $preco_custo;
        self::$recordset[$id]['estoque'] = $unidades;
    }

    /*
     * metodo registravenda
     * registra uma venda e decrementa o estoque
     * @param $unidade = unidades vendidas
     */

    public function registraVenda($id, $unidades) {
        self::$recordset[$id]['estoque'] -= $unidades;
    }

    /*
     * metodo getestoque
     * retorna a quantidade em estoque
     */

    public function getEstoque($id) {
        return self::$recordset[$id]['estoque'];
    }

    /*
     * metodo calculaprecovenda
     * retorna o preco de venda baseado em uma margem de 30% sobre o custo
     */

    public function calculaPrecoVenda($id) {
        return self::$recordset[$id]['preco_custo'] * 1.3;
    }

}

// instancia objeto produto
$produto = new Produto();

// adiciona alguns produtos
$produto->adicionar(1, 'Vinho', 10, 15);
$produto->adicionar(2, 'Salame', 20, 20);

// exibe os estoques atuais
echo 'estoques: <br />';
echo $produto->getEstoque(1) . '<br />';
echo $produto->getEstoque(2) . '<br />';

// exibe os precos de venda
echo 'preço de venda: <br />';
echo $produto->calculaPrecoVenda(1) . '<br />';
echo $produto->calculaPrecoVenda(2) . '<br />';

// vende algumas unidades
$produto->registraVenda(1, 5);
$produto->registraVenda(2, 10);

// repoe o estoque
$produto->registraCompra(1, 5, 16);
$produto->registraCompra(2, 10, 22);

// exibe os precos de venda atuais
echo 'preços de venda: <br />';
echo $produto->calculaPrecoVenda(1) . '<br />';
echo $produto->calculaPrecoVenda(2) . '<br />';
