<?php
/*
 * funcao __autoload()
 * carrega uma classe quando ela e necessaria ou seja quando ela e instanciada 
 * pela primeira vez.
 */

function __autoload($classe){
    if(file_exists("app.ado/{$classe}.class.php")){
        include_once "app.ado/{$classe}.class.php";
    }
}
// cria criterio de selecao de dados
$criteria = new TCriteria();
$criteria->add(new TFilter('id', ' = ', ' 3 '));

// cria instrucao de delete
$sql = new TSqlDelete();

// define a entidade
$sql->setEntity('aluno');

// define o criterio de selecao de dados
$sql->setCriteria($criteria);

// processa a instrucao sql
echo $sql->getInstruction();
echo '<br />';