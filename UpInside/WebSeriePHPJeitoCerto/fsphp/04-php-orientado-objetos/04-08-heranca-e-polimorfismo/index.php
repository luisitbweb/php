<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("04.08 - Herança e polimorfismo");

require __DIR__ . "/source/autoload.php";

/*
 * [ classe pai ] Uma classe que define o modelo base da estrutura da herança
 * http://php.net/manual/pt_BR/language.oop5.inheritance.php
 */
fullStackPHPClassSession("classe pai", __LINE__);

$event = new \Source\Inheritance\Event\Event(
        "Workshop FSPHP",
        new DateTime("2019-05-20 16:00"),
        2500,
        "4"
);

echo '<pre>';
var_dump($event);
echo '</pre>';

$event->register("Luís Carlos", "cursos@upinside.com.br");
$event->register("Robson Leite", "cursos@upinside.com.br");
$event->register("Kaue", "cursos@upinside.com.br");
$event->register("Gah", "cursos@upinside.com.br");
$event->register("Gustavo", "cursos@upinside.com.br");
$event->register("João", "cursos@upinside.com.br");
/*
 * [ classe filha ] Uma classe que herda a classe pai e especializa seuas rotinas
 */
fullStackPHPClassSession("classe filha", __LINE__);

$address = new \Source\Inheritance\Address("Rua dos eventos", 1287);
$events = new \Source\Inheritance\Event\EventLive(
        "Workshop FSPHP",
        new DateTime("2019-05-20 16:00"),
        2500,
        "4",
        $address
);

echo '<pre>';
var_dump($events);
echo '</pre>';

$events->register("Luís Carlos", "cursos@upinside.com.br");
$events->register("Robson Leite", "cursos@upinside.com.br");
$events->register("Kaue", "cursos@upinside.com.br");
$events->register("Gah", "cursos@upinside.com.br");
$events->register("Gustavo", "cursos@upinside.com.br");
$events->register("João", "cursos@upinside.com.br");

/*
 * [ polimorfismo ] Uma classe filha que tem métodos iguais (mesmo nome e argumentos) a class
 * pai, mas altera o comportamento desses métodos para se especializar
 */
fullStackPHPClassSession("polimorfismo", __LINE__);

$events = new \Source\Inheritance\Event\EventOnline(
        "Workshop FSPHP",
        new DateTime("2019-05-20 16:00"),
        197,
        "http://upinside.com.br/aovivo"
);

echo '<pre>';
var_dump($events);
echo '</pre>';

$events->register("Luís Carlos", "cursos@upinside.com.br");
$events->register("Robson Leite", "cursos@upinside.com.br");
$events->register("Kaue", "cursos@upinside.com.br");
$events->register("Gah", "cursos@upinside.com.br");
$events->register("Gustavo", "cursos@upinside.com.br");
$events->register("João", "cursos@upinside.com.br");