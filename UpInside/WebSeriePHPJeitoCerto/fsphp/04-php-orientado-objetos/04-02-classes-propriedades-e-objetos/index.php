<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.02 - Classes, propriedades e objetos");

/*
 * [ classe e objeto ] http://php.net/manual/pt_BR/language.oop5.basic.php
 */
fullStackPHPClassSession("classe e objeto", __LINE__);

require __DIR__ . "/classes/User.php";

$user = new User();
echo '<pre>';
var_dump($user);
echo '</pre>';

/*
 * [ propriedades ] http://php.net/manual/pt_BR/language.oop5.properties.php
 */
fullStackPHPClassSession("propriedades", __LINE__);

$user->firstName = "Luís";
$user->lastName = "Carlos";
$user->email = "cursos";

echo '<pre>';
var_dump($user);
echo '</pre>';

echo "<p>O e-mail de {$user->firstName} é {$user->email}!</p>";

/*
 * [ métodos ] São as funções que definem o comportamento e a regra de negócios de uma classe
 */
fullStackPHPClassSession("métodos", __LINE__);

$user->setFirstName("Luís Carlos");
$user->setLastName("Da Silva Santos");

if(!$user->setEmail("cursos@upinside.com.br")){
    echo "<p class'trigger error'>O e-mail {$user->getEmail()} Não é válido!</p>";
}
$user->setEmail("cursos");

echo '<pre>';
var_dump($user);
echo '</pre>';