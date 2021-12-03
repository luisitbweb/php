<?php
/*
 * funcao __autoload()
 * carrega uma classe quando ela e necessaria ou seja quando ela
 * e instanciada pela primeira vez.
 */

function __autoload($classe){
    if(file_exists("app.ado/{$classe}.class.php")){
        include_once "app.ado/{$classe}.class.php";
    }
}

// cria criterio de selecao de dados
$criteria = new TCriteria();
$criteria->add(new TFilter(' nome ', ' LIKE ', ' maria% '));
$criteria->add(new TFilter(' cidade ', ' LIKE ', ' Porto% '));

// define o intervalo de consulta
$criteria->setProperty(' offset ', 0);
$criteria->setProperty(' limit ', 10);

// define o ordenamento da consulta 
$criteria->setProperty(' order ', ' nome ');

// cria instrucao de select
$sql = new TSqlSelect();

// define o nome da entidade
$sql->setEntity(' aluno ');

// acrescenta colunas a consulta
$sql->addColumn(' nome ');
$sql->addColumn(' fone ');

// define o criterio de selecao de dados
$sql->setCriteria($criteria);

// processa a instrucao sql
echo $sql->getInstruction();
echo '<br />';