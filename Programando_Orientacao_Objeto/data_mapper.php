<?php

/*
 * class produto
 * representa um produto a ser vendido
 */

final class Produto {

    private $descricao, $estoque, $preco_custo; // descricao do produto, estoque atual, preco de custo

    /*
     * metodo construtor
     * define alguns valores iniciais
     * @param $descricao = descricao do produto
     * @param $estoque = estoque atual
     * @param $preco_custo = preco de custo
     */

    public function __construct($descricao, $estoque, $preco_custo) {
        $this->descricao = $descricao;
        $this->estoque = $estoque;
        $this->preco_custo = $preco_custo;
    }

    /*
     * metodo getDescricao
     * retorna a descricao do produto
     */

    public function getDescricao() {
        return $this->descricao;
    }

}

/*
 * classe venda
 * representa uma venda de produtos
 */

final class Venda {

    private $id, $itens; // itens da cesta

    /*
     * metodo construtor
     * instancia uma nova venda
     * @param $id = identificador
     */

    function __construct($id) {
        $this->id = $id;
    }

    /*
     * metodo getId
     * retorna o identificador
     */

    function getID() {
        return $this->id;
    }

    /*
     * metodo addItem
     * adiciona um item na cesta
     * @param $quantidade = quantidade vendida
     * @param $produto = objeto produto
     */

    public function addItem($quantidade, Produto $produto) {
        $this->itens[] = [$quantidade, $produto];
    }

    /*
     * metodo getItems
     * retorna o array de itens da cesta
     */

    public function getItens() {
        return $this->itens;
    }

}

/*
 * class venda mapper
 * implementa data mapper para a classe venda
 */

final class VendaMapper {

    function insert(Venda $venda) {
        $id = $venda->getID();
        $date = date("Y-m-d");

        // insere a venda no banco de dados
        $sql = "INSERT INTO `venda` (`id`, `data`) VALUES ('$id', '$date')";
        echo $sql . '<br />';

        // percorre os itens vendidos
        foreach ($venda->getItens() as $item) {
            $quantidade = $item[0];
            $produto = $item[1];
            $descricao = $produto->getDescricao();

            // insere os itens da venda no banco de dados
            $sql = "INSERT INTO `venda_items` (`ref_venda`, `produto`, `quantidade`) VALUES "
                    . "('$id', '$descricao', '$quantidade')";

            echo $sql . '<br />';
        }
    }

}

// instancia objeto venda
$venda = new Venda(1000);

// adiciona alguns produtos
$venda->addItem(3, new Produto('Vinho', 10, 15));
$venda->addItem(2, new Produto('Salame', 20, 20));
$venda->addItem(1, new Produto('Queijo', 30, 10));

// data mapper persiste a venda
VendaMapper::insert($venda);