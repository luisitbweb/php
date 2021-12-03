<?php

/*
 * classe produto
 * implementa active record
 */

class Produto {

    private $data;

    function __get($prop) {
        return $this->data[$prop];
    }

    function __set($prop, $value) {
        $this->data[$prop] = $value;
    }

    /*
     * metodo insert
     * armazena o objeto na tabela de produtos
     */

    function insert() {
        // cria instrucao sql de insert
        $sql = "INSERT INTO `produtos` (`id`, `descricao`, `estoque`, `preco_custo`,) VALUES"
                . "('{$this->id}', '{$this->descricao}', "
                . "'{$this->estoque}', '{$this->preco_custo}')";

        // instancia objeto pdo
        $conn = new PDO('sqllite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        // executa instrucao sql
        $conn->exec($sql);
        unset($conn);
    }

    /*
     * metodo update
     * altera os dados do objeto na tabela de produtos
     */

    function update() {
        // cria instrucao sql e update
        $sql = "UPDATE `produtos` SET "
                . "`descricao` = '{$this->descricao}', "
                . "`estoque` = '{$this->estoque}', "
                . "`preco_custo` = '{$this->preco_custo}' WHERE "
                . "`id` = '{$this->id}'";

        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        // executa instrucao sql
        $conn->exec($sql);
        unset($conn);
    }

    /*
     * metodo delete
     * deleta o objeto da tabela de produtos
     */

    function delete() {
        // cria instrucao sql de delete
        $sql = "DELETE FROM `produtos` WHERE `id` = '{$this->id}'";

        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        // executa instrucao sql
        $conn->exec($sql);
        unset($conn);
    }

    /*
     * metodo registracompra
     * registra uma compra atualizada custo e incrementa o estoque atual
     * @param $unidades = unidades adquiridas
     * @param $preco_custo = novo preco de custo
     */

    public function registraCompra($unidades, $preco_custo) {
        $this->preco_cuto = $preco_custo;
        $this->estoque += $unidades;
    }

    /*
     * metodo registravenda
     * registra uma venda e decrementa o estoque
     * @param $unidades = unidades vendidas
     */

    public function registraVenda($unidades) {
        $this->estoque -= $unidades;
    }

    /*
     * metodo calculaprecovenda
     * retorna o preco de venda baseado em uma margem de 30% sobre o custo
     */

    public function calculaPrecoVenda() {
        return $this->preco_custo * 1.3;
    }

}
// instancia objeto produto
$vinho = new Produto();
$vinho->id          = 1;
$vinho->descricao   = 'Vinho Cabernet';
$vinho->estoque     = 10;
$vinho->preco_custo = 10;
$vinho->insert();

$vinho->registraVenda(5);
echo 'Estoque: "' . $vinho->estoque . '"<br />';
echo 'preço de custo: "' . $vinho->preco_custo . '"<br />';
echo 'Preço de venda: "' . $vinho->calculaPrecoVenda() . '"<br />';

$vinho->registraCompra(10, 20);
$vinho->update();
echo 'Estoque: "' . $vinho->estoque . '"<br />';
echo 'Preço de custo: "' . $vinho->preco_custo . '"<br />';
echo 'Preço de venda: "' . $vinho->calculaPrecoVenda() . '"<br />';