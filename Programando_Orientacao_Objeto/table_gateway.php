<?php
/*
 * classe produtogateway
 * implementa table data gatway
 */

class ProdutoGateWay{
    /*
     * metodo insert
     * insere dados na tabela de produtos
     * @param $id = id do produto
     * @param $descricao = descricao do produto
     * @param $estoque = estoque atual
     * @param $preco_custo = preco de custo
     */
    
    function insert($id, $descricao, $estoque, $preco_custo){
        // cria instrucao sql de insert
        $sql = 'INSERT INTO Produtos(`id`, `descricao`, `estoque`, `preco_custo`) VALUES ("' . $id . ',' . $descricao . ',' . $estoque . ',' . $preco_custo . '")';
        
        // instancia objeto PDO
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa instrucao sql
        $conn->exec($sql);
        unset($conn);
    }
    /*
     * metodo update
     * altera os dados na tabela de produtos
     * @param $id = id do produto
     * @param $descricao = descricao do produto
     * @param $estoque = estoque atual
     * @param $preco_custo = preco de custo
     */
    
    function update($id, $descricao, $estoque, $preco_custo){
        // cria instrucao sql de update
        $sql = 'UPDATE `produtos` SET `descricao` = "' . $descricao . '", `estoque` = "' . $estoque . '", `preco_custo` = "' . $preco_custo . '" WHERE `id` = ' . $id;
        
        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa instrucao sql
        $conn->exec($sql);
        unset($conn);
    }
    /*
     * metodo delete
     * deleta um registro na tabela de produtos
     * @param $id = id do produto
     */
    
    function delete($id){
        // cria instrucao sql de delete
        $sql = 'DELETE FROM `produtos` WHERE `id` = ' . $id;
        
        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa instrucao sql
        $conn->exec($sql);
        unset($conn);
    }
    /*
     * metodo getobjet
     * busca um registro da tabela de produtos
     * @param $id = id do produto
     */
    
    function getObject($id){
        // cria instrucao sql de select
        $sql = 'SELECT * FROM `produtos` WHERE `id` = ' . $id;
        
        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa a consulta sql
        $result = $conn->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        
        unset($conn);
        return $data;
    }
    /*
     * metodo getObjects
     * lista todos registros da tabela de produtos
     */
    
    function getObjects(){
        // cria instrucao sql de select
        $sql = 'SELECT * FROM `produtos`';
        
        // instancia objeto pdo
        $conn = new PDO('sqlite:produtos.db');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
        // executa a consulta sql
        $result = $conn->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        
        unset($conn);
        return $data;
    }
}

// instancia objeto produtogateway
$gateway = new ProdutoGateWay();

// insere alguns registros na tabela
$gateway->insert(1, 'Vinho', 10, 10);
$gateway->insert(2, 'Salame', 20, 20);
$gateway->insert(3, 'Queijo', 30, 30);

// efetua algumas alteracoes
$gateway->update(1, 'Vinho', 20, 20);
$gateway->update(2, 'Salame', 40, 40);

// exclui o produto 3
$gateway->delete(3);

// exibe novamente os registros
echo 'Lista de produtos<br />';
print_r($gateway->getObjects());