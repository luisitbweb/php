<?php
/*
 * funcao __autoload()
 * carrega uma classe quando ela e e necessario ou seja quando ela
 *  e instanciada pela primeira vez
 */

function __autoload($classe){
    if (file_exists("app.ado/{$classe}.class.php")){
        include_once "app.ado/{$classe}.class.php";
    }
}

// cria criterio de selecao de dados
$criteria = new TCriteria();
$criteria->add(new TFilter('id', ' = ', ' 3 '));

// cria instrucao de update
$sql = new TSqlUpdate();

// define a entidade
$sql->setEntity('aluno');

// atribui o valor de cada coluna
$sql->setRowData('nome', 'Pedro Cardoso da Silva');
$sql->setRowData('rua', 'Machado de Assis');
$sql->setRowData('fone', '(64) 3404-2568');

// define o criterio de selecao de dados
$sql->setCriteria($criteria);

// processa a instrucao sql
echo $sql->getInstruction();
echo '<br />';