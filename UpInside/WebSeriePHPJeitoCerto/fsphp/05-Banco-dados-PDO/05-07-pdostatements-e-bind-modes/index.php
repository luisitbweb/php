<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.07 - PDOStatement e bind modes");

require __DIR__ . "./source/autoload.php";

use Source\Database\Connect;

/**
 * [ prepare ] http://php.net/manual/pt_BR/pdo.prepare.php
 */
fullStackPHPClassSession("prepared statement", __LINE__);

$stmt = Connect::getInstance()->prepare("SELECT * FROM users LIMIT 1");
$stmt->execute();

echo '<pre>';
var_dump(
    $stmt,
    $stmt->rowCount(),
    $stmt->columnCount(),
    $stmt->fetch()
);
echo '</pre>';

/*
 * [ bind value ] http://php.net/manual/pt_BR/pdostatement.bindvalue.php
 *
 */
fullStackPHPClassSession("stmt bind value", __LINE__);

$stmt1 = Connect::getInstance()->prepare("INSERT INTO users (first_name, last_name) VALUE (?, ?)");

$stmt1->bindValue(1, 'Gustavo', PDO::PARAM_STR);
$stmt1->bindValue(2, 'Web', PDO::PARAM_STR);

$stmt1->execute();
echo '<pre>';
var_dump($stmt1->rowCount(), Connect::getInstance()->lastInsertId());
echo '</pre>';

$stmt2 = Connect::getInstance()->prepare("INSERT INTO users (first_name, last_name) VALUE (:first_name, :last_name)");

$nome = "Gustavo";

$stmt2->bindValue(":first_name", $nome, PDO::PARAM_STR);
$stmt2->bindValue(":last_name", "Web", PDO::PARAM_STR);

$stmt2->execute();
echo '<pre>';
var_dump($stmt2->rowCount());
echo '</pre>';

/*
 * [ bind param ] http://php.net/manual/pt_BR/pdostatement.bindparam.php
 */
fullStackPHPClassSession("stmt bind param", __LINE__);

$stmt3 = Connect::getInstance()->prepare("INSERT INTO users (first_name, last_name) VALUE (:first_name, :last_name)");

$firstName = "Gah";
$lastName = "Morandi";

$stmt3->bindParam(":first_name", $firstName, PDO::PARAM_STR);
$stmt3->bindParam(":last_name", $lastName, PDO::PARAM_STR);

$stmt3->execute();
echo '<pre>';
var_dump($stmt3->rowCount());
echo '</pre>';

/*
 * [ execute ] http://php.net/manual/pt_BR/pdostatement.execute.php
 */
fullStackPHPClassSession("stmt execute array", __LINE__);

$stmt4 = Connect::getInstance()->prepare("INSERT INTO users (first_name, last_name) VALUE (:first_name, :last_name)");

$user = [
    "first_name" => "kaue",
    "last_name" => "Cardoso"
];

$stmt4->execute($user);
echo '<pre>';
var_dump($stmt4->rowCount());
echo '</pre>';

/*
 * [ bind column ] http://php.net/manual/en/pdostatement.bindcolumn.php
 */
fullStackPHPClassSession("bind column", __LINE__);

$stmt5 = Connect::getInstance()->prepare("SELECT * FROM users LIMIT 3");
$stmt5->execute();

$stmt5->bindColumn("first_name", $name);
$stmt5->bindColumn("email", $email);

foreach ($stmt5->fetchAll() as $user){
    echo '<pre>';
    var_dump($user);
    echo "O e-mail de {$name} é {$email}";
    echo '</pre>';
}