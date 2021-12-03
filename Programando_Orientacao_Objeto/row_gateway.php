<?php

/*
 * classe produtogateway
 * implementa row data gateway
 */

class ProdutoGateway {

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
        $sql = "INSERT INTO `Produtos`(`id`, `descricao`, `estoque`, `preco_custo`) VALUES "
                . "( '{$this->id}', '{$this->descricao}', '{$this->estoque}', '{$this->preco_custo}')";

        echo $sql . '<br />';

        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
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
        // cria instrucao sql de update
        $sql = "UPDATE `produtos` SET "
                . "`descricao`   =  '{$this->descricao}', "
                . "`estoque`     =  '{$this->estoque}', "
                . "`preco_custo` =  '{$this->preco_custo}',  WHERE "
                . "`id`          = '{$this->id}'";

        echo $sql . '<br />';

        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        // executa a instrucao sql
        $conn->exec($sql);
        unset($conn);
    }
    /*
     * metodo delete
     * deleta o objeto da tabela de produtos
     */
    
    function delete(){
        // cria instrucao sql delete
        $sql = "DELETE FROM `produtos` WHERE `id` = '{$this->id}'";
        echo $sql . '<br />';
        
        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa instrucao sql
        $conn->exec($sql);
        unset($conn);
    }
    
    /*
     * metodo getobject
     * carrega um objeto a partir da tabela de produtos
     */
    
    function getObject($id){
        // cria instrucao sql de select
        $sql = "SELECT * FROM `produtos` WHERE id = '{$this->id}'";
        
        echo $sql . '<br />';
        
        //instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa consulta sql
        $result = $conn->query($sql);
        $this->data = $result->fetch(PDO::FETCH_ASSOC);
        unset($conn);
    }

}
// insere produtos na base dedaos
$vinho = new ProdutoGateway();
$vinho->id          = 1;
$vinho->descricao   = 'Vinho Cabernet';
$vinho->estoque     = 10;
$vinho->preco_custo = 10;
$vinho->insert();

$salame = new ProdutoGateway();
$salame->id        = 2;
$salame->descricao = 'Salame';
$salame->estoque = 20;
$salame->preco_custo = 20;
$salame->insert();

// recupera um objeto e realiza alteracao
$objeto = new ProdutoGateway();
$objeto->getObject(2);
$objeto->estoque = $objeto->estoque * 2;
$objeto->descricao = 'Salaminho Italiano';
$objeto->update();

// exclui o produto vinho da tabela
$vinho->delete();