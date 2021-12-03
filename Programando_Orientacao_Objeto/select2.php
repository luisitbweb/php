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

// cria criterio de selecao de dados
$criteria1 = new TCriteria();

/*
 * seleciona todas as meninas f
 * que estao na terceira 3 serie
 */

$criteria1->add(new TFilter('sexo', ' = ', 'F'));
$criteria1->add(new TFilter('serie', ' = ', '3'));

/*
 * seleciona todos os meninos m
 * que estao na quarta 4 serie
 */

$criteria2 = new TCriteria();
$criteria2->add(new TFilter('sexo', ' = ', 'M'));
$criteria2->add(new TFilter('serie', ' = ', '4'));

/*
 * agora juntamos os dois criterios utilizando
 * o operador logico or ou o resultado deve conter
 * meninas da 3a serie ou meninos da 4a serie
 */

$criteria = new TCriteria();
$criteria->add($criteria1, TExpression::OR_OPERATOR);
$criteria->add($criteria2, TExpression::OR_OPERATOR);

// define o ordenamento
$criteria->setProperty(' order ', ' nome ');

// cria instucao de select
$sql = new TSqlSelect;

// define o nome da entidade
$sql->setEntity('aluno');

// acrescenta todas colunas a consulta
$sql->addColumn(' * ');

// define o criterio de selecao de dados
$sql->setCriteria($criteria);

//processa a instrucao sql
echo $sql->getInstruction();
echo '<br />';
