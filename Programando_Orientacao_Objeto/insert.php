<?php
/*
 * funcao __autoload()
 * carrega uma classe quando ela e necessaria ou seja quando ela e instancia pela
 * primeira vez
 */

function __autoload($classe){
    if (file_exists("app.ado/{$classe}.class.php")){
        include_once "app.ado/{$classe}.class.php";
    }
}

/*
 * define o locale do sistema para permitir ponto decimal
 * ps: no windows, usar english
 */

setlocale(LC_NUMERIC, 'english');

// cria uma instrucao de insert
$sql = new TSqlInsert();
 
// define o nome da entidade
$sql->setEntity('aluno');

// atribui o valor de cada coluna
$sql->setRowData('id', 3);
$sql->setRowData('nome', 'Pedro Cardoso');
$sql->setRowData('fone', '(64) 3431-5621');
$sql->setRowData('nascimento', '1985-04-12');
$sql->setRowData('sexo', 'M');
$sql->setRowData('serie', '4');
$sql->setRowData('mensalidade', '280.40');

// precissa a instrucao sql
echo $sql->getInstruction();
echo '<br />';