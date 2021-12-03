<?php
/*
 * funcao __autoload()
 * carrega uma classe quando ela e necessaria
 * ou seja quando ela e instanciada pela primeira vez
 */

function __autoload($classe){
    if (file_exists("app.ado/{$classe}.class.php")){
        include_once "app.ado/{$classe}.class.php";
    }
}

try{
    // abre uma transacao
    TTransaction::open('pg_livro');
    
    // define a estrategia d log
    TTransaction::setLogger(new TLoggerHTML('tmp/arquivo.html'));
    
    // escreve mensagem de log
    TTransaction::log('Inserindo registro William Wallace');
    
    // cria uma instrucao de insert
    $sql = new TSqlInsert();
    
    // define o nome da entidade
    $sql->setEntity('famosos');
    
    // atribui o valor de cada coluna
    $sql->setRowData('codigo', 9);
    $sql->setRowData('nome', 'William Wallace');
    
    // obtem a conexao ativa
    $conn = TTransaction::get();
    
    // executa a instrucao sql
    $result = $conn->Query($sql->getInstruction());
    
    // escreve mensagem de log
    TTransaction::log($sql->getInstruction());
    
    // define a estrategia de log
    TTransaction::setLogger(new TLoggerXML('tmp/arquivo.xml'));
    
    // escreve mensagem de log
    TTransaction::log('Inserindo registro Albert Einstein');
    
    // cria uma instrucao de insert
    $sql = new TSqlInsert();
    
    // define o nome da entidade
    $sql->setEntity('famosos');
    
    // atribui o valor de cada coluna
    $sql->setRowData('codigo', 10);
    $sql->setRowData('nome', 'Albert Einstein');
    
    // obtem a conexao ativa
    $conn = TTransaction::get();
    
    // executa a instrucao sql
    $result = $conn->Query($sql->getInstruction());
    
    // escreve mensagem de log
    TTransaction::log($sql->getInstruction());
    
    // fecha a transacao aplicando todas as operacoes
    TTransaction::close();
} catch (Exception $e) {
    // exibe a mensagem de erro
    echo $e->getMessage();
    
    // desfaz operacoes realizadas durante a transacoes
    TTransaction::rollback();
}