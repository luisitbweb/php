<?php
/*
 * class produto
 * representa um produto a ser vendido
 */

final class Produto{
    private $descricao, $estoque, $preco_custo; // descricao do produto estoque atual preco de custo
    
    /*
     * metodo construtor
     * define alguns valores iniciais
     * @param $descricao = descricao do produto
     * @param $estoque = estoque atual
     * @param $preco_custo = preco de custo
     */
    
    public function __construct($descricao, $estoque, $preco_custo) {
        $this->descricao   = $descricao;
        $this->estoque     = $estoque;
        $this->preco_custo = $preco_custo;
    }
    /*
     * metodo registracompra
     * registra uma compra atualiza custo e incrementa 
     * o estoque atual @param $unidades = nunidades adquiridas
     * @param $preco_custo = novo preco de custo
     */
    
    public function registraCompra($unidades, $preco_custo){
        $this->preco_custo  = $preco_custo;
        $this->estoque     += $unidades;
    }
    /*
     * metodo registravenda
     * registra uma venda e decrementa o estoque
     * @param $unidades = unidade vendidas
     */
    
    public function registraVenda($unidades){
        $this->estoque -= $unidades;
    }
    /*
     * metodo getestoque
     * retorna a quantidade em estoque
     */
    public function getEstoque(){
        return $this->estoque;
    }
    /*
     * metodo calculaprecovenda
     * retorna o preco de venda baseado em 
     * uma margem de 30% sobre o custo
     */
    
    public function calculaPrecoVenda(){
        return $this->preco_custo * 1.3;
    }
}

/*
 * classe venda
 * representa uma venda de produtos
 */

final class Venda{
    private $itens; // itens da venda
    
    /*
     * metodo additem
     * adiciona um item na venda
     * @param $quantidade = quantidade vendida
     * @param $produto = objeto produto
     */
    
    public function addItem($quantidade, Produto $produto){
        
        $this->itens[] = array($quantidade, $produto);
    }
    /*
     * metodo getItems
     * retorna o array de itens da venda
     */
    
    public function getItens(){
        return $this->itens;
    }
}

// instancia objeto venda
$venda = new Venda();

// adiciona alguns produtos
$venda->addItem(3, new Produto('Vinho', 10, 15));
$venda->addItem(2, new Produto('Salame', 20, 20));
$venda->addItem(1, new Produto('Queijo', 30, 10));

/*
 * rotina para calcular o total
 * de uma venda e diminuir o estoque
 */

$total = 0;
foreach ($venda->getItens() as $item){
    $quantidade = $item[0];
    $produto    = $item[1];
    
    // soma o total
    $total += $produto->calculaPrecoVenda() * $quantidade;
    
    // diminui estoque
    $produto->registraVenda($quantidade);
}
echo $total;