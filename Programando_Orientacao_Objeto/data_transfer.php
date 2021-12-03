<?php
/*
 * classe produtogateway
 * implementa table data gateway com data transfer object
 */

class ProdutoGateway{
    /*
     * metodo insert
     * insere dados na tabela de produtos
     * @param $object = objeto a ser inserido
     */
    
    function insert(Produto $object){
        // cria instrucao sql de insert
        $sql = 'INSERT INTO `Produtos`(`id`, `descricao`, `estoque`, `preco_custo`) VALUES '
                . '("' . $object->id . ',' . $object->Descricao . ',' . $object->estoque . ',' . $object->preco_custo . '")';
        
        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa instrucao sql
        $conn->exec($sql);
        unset($conn);
    }
    /*
     * metodo update
     * altera os dados na tabela de produtos
     * @param $object = objeto a ser alterado
     */
    
    function update(Produto $object){
        // cria instrucao sql de update
        $sql = 'UPDATE `produtos` SET '
                . '`descricao`      = "' . $object->Descricao . '",'
                . '`estoque`        = "' . $object->estoque . '",'
                . '`preco_custo`    = "' . $object->preco_custo . '" WHERE '
                . '`id`             = "' . $object->id . '"';
        
        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa instrucao sql
        $conn->exec($sql);
        unset($conn);
    }
    /*
     * metodo getObject
     * busca um registro da tabela de produtos
     * @param $id = id do produto
     */
    
    function getObject($id){
        // cria instrucao sql de select
        $sql = 'SELECT * FROM `produtos` WHERE `id` = ' . $id;
        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa consulta sql
        $result = $conn->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        unset($conn);
        return $data;
    }
}

class Produto{
    public $id, $descricao, $estoque, $preco_custo;
}
// instancia objeto produtoGateway
$gateway = new ProdutoGateway();

$vinho = new Produto();
$vinho->id  = 1;
$vinho->descricao = 'vinho';
$vinho->estoque = 10;
$vinho->preco_custo = 15;

// insere o objeto no banco de dados
$gateway->insert($vinho);

// exibe o objeto de codigo 1
print_r($gateway->getObject(1));

$vinho->descricao = 'Vinho Cabernet';

// atualiza o objeto no banco de dados
$gateway->update($vinho);

// exibe o objeto de codigo 1
print_r($gateway->getObject(1));