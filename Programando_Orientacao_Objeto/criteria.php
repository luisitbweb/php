<?php

// carrega as classes necessarias
include_once 'app.ado/TExpression.class.php';
include_once 'app.ado/TCriteria.class.php';
include_once 'app.ado/TFilter.class.php';

/*
 * aqui vemos um exemplo de criterio utilizando o operador logico or
 * a idade deve ser menor que 16 ou maior que 60
 */

$criteria1 = new TCriteria();
$criteria1->add(new TFilter(' idade ', ' < ', 16), TExpression::OR_OPERATOR);
$criteria1->add(new TFilter(' idade ', ' > ', 60), TExpression::OR_OPERATOR);
echo $criteria1->dump();
echo "<br />";

/*
 * aqui vemos um exemplo de criterio utilizando o operador logico and
 *  nuntamente com os operadores de conjunto in dentro do conjunto e not in fora do conjunto
 *  a idade deve estar dentro de conjunto 24, 25, 26 e deve estar fora do conjunto 10 
 */

$criteria2 = new TCriteria();
$criteria2->add(new TFilter(' idade ', ' IN ', array(24, 25, 26)));
$criteria2->add(new TFilter(' idade ', ' NOT IN ', array(10)));
echo $criteria2->dump();
echo '<br />';

/*
 * aqui vemos um exemplo de criterio utilizando o operador de comparacao like
 * o nome deve iniciar por pedro ou deve iniciar por maria
 */

$criteria3 = new TCriteria();
$criteria3->add(new TFilter(' nome ', ' LIKE ', ' pedro% '), TExpression::OR_OPERATOR);
$criteria3->add(new TFilter(' nome ', ' LIKE ', ' maria% '), TExpression::OR_OPERATOR);
echo $criteria3->dump();
echo '<br />';

/*
 * aqui vemos um exemplo de criterio utilizando os operadores = e is not
 * neste caso o telefone nao pode conter valor nulo is not null
 * e o sexo deve ser feminino sexo=f
 */

$criteria4 = new TCriteria();
$criteria4->add(new TFilter(' telefone ', ' IS NOT ', NULL));
$criteria4->add(new TFilter(' sexo ', ' = ', ' F '));
echo $criteria4->dump();
echo '<br />';

/*
 * aqui vemos o uso dos operadores de comparacao in e not in juntamente com
 * conjuntos de strings neste caso a uf deve estar entre rs, sc e pr e
 * nao deve estar entre ac e pi.
 */

$criteria5 = new TCriteria();
$criteria5->add(new TFilter(' UF ', ' IN ', array(' RS ', ' SC ', ' PR ')));
$criteria5->add(new TFilter(' UF ', ' NOT IN ', array(' AC ', ' PI ')));
echo $criteria5->dump();
echo "<br />";

/*
 * neste caso temos o uso de um criterio composto
 * o primeiro criterio aponta para sexo=f
 * sexo feminino e idade > 18 maior de idade
 */

$criteria6 = new TCriteria();
$criteria6->add(new TFilter(' sexo ', ' = ', ' F '));
$criteria6->add(new TFilter(' idade ', ' > ', ' 18 '));

/*
 * o segundo criterio aponta para sexo=m masculino
 * e idade < 16 menor de idade
 */

$criteria7 = new TCriteria();
$criteria7->add(new TFilter(' sexo ', ' = ', ' M '));
$criteria7->add(new TFilter(' idade ', ' < ', ' 16 '));

/*
 * agora juntamos os dois criterios utilizando o operador logico or ou o resultado
 * deve conter mulheres maiores de 18 ou homens menores de 16
 */

$criteria8 = new TCriteria();
$criteria8->add($criteria6, TExpression::OR_OPERATOR);
$criteria8->add($criteria7, TExpression::OR_OPERATOR);
echo $criteria8->dump();
echo '<br />';
