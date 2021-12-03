<?php

/*
 * funcao __autoload()
 * carrega uma classe quando ela e necessaria
 * ou seja quando ela e instanciada pela primeira vez
 */

function __autoload($classe) {
    if (file_exists("app.ado/{$classe}.class.php")) {
        include_once "app.ado/{$classe}.class.php";
    }
}

try {
    // abre uma transacao
    TTransaction::open('pg_livro');

    // cria uma instrucao de insert
    $sql = new TSqlInsert;

    // define o nome da entidade
    $sql->setEntity('famosos');

    // atribui o valor de cada coluna
    $sql->setRowData('codigo', 8);
    $sql->setRowData('nome', 'galileu');

    // obtem a conexao ativa
    $conn = TTransaction::get();

    // executa a instrucao sql
    $result = $conn->Query($sql->getInstruction());

    // cria uma instrucao de update
    $sql = new TSqlUpdate();

    // define o nome da entidade
    $sql->setEntity('famosos');

    // atribui o valor de cada coluna
    $sql->setRowData('nome', 'galileu galilei');

    // cria criterio de selecao de dados
    $criteria = new TCriteria();

    // obtem a pessoa de codigo '8'
    $criteria->add(new TFilter('codigo', '=', '8'));

    // atribui o criterio de selecao de dados
    $sql->setCriteria($criteria);

    // obtem a conexao ativa
    $conn = TTransaction::get();

    // executa a instrucao sql
    $result = $conn->Query($sql->getInstruction());

    // fecha a transacao aplicando todas operacoes
    TTransaction::close();
} catch (Exception $e) {
    // exibe a mensagem de erro
    echo $e->getMessage();

    // desfaz operacoes realizadas durante a transacao
    TTransaction::rollback();
}