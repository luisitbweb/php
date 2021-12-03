<?php

/*
 * funcao __autoload()
 * carrega uma classe quando ela e necessario
 * ou seja quando ela e instanciada pela primeira vez
 */

function __autoload($classe) {
    if (file_exists("app.ado/{$classe}.class.php")) {
        include_once "app.ado/{$classe}.class.php";
    }
}

// cria instrucao de select
$sql = new TSqlSelect();

// define o nome da entidade
$sql->setEntity('famosos');

// acrescenta colunas a consulta
$sql->addColumn(' codigo ');
$sql->addColumn(' nome ');

// cria criterio de selecao de dados
$criteria = new TCriteria();

// obtem a pessoa de codigo '1'
$criteria->add(new TFilter(' codigo ', ' = ', ' 1 '));

// atribui o criterio de selecao de dados
$sql->setCriteria($criteria);

try {
    // abre conexao com a base my_livro(mysql)
    $conn = TConnection::open('my_livro');

    // executa a instrucao sql
    $result = $conn->query($sql->getInstruction());
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);

        // exibe os dados resultantes
        echo $row['codigo'] . ' - ' . $row['nome'] . 'br />';
    }
    // fecha a conexao
    $conn = NULL;
} catch (Exception $e) {
    // exibe a mensagem de erro
    print "ERRO!: " . $e->getMessage() . '<br />';
    die();
}

try {
    // abre conecao com a base pg_livro (postgres)
    $conn = TConnection::open('pg_livro');

    // executa a instrucao sql
    $result = $conn->query($sql->getInstruction());
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);

        // exibe os dados resultantes
        echo $row['codigo'] . ' - ' . $row['nome'] . '<br />';
    }
    // fecha a conexao
    $conn = NULL;
} catch (Exception $e) {
    // exibe a mensagem de erro
    print "ERRO!: " . $e->getMessage() . '<br />';
    die();
}