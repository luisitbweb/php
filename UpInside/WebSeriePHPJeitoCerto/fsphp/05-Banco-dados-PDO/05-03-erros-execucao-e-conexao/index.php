<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.03 - Errors, conexão e execução");

/*
 * [ controle de erros ] http://php.net/manual/pt_BR/language.exceptions.php
 */
fullStackPHPClassSession("controle de erros", __LINE__);

try{
    throw new Exception("Exception");
    throw new PDOException("PDOException");
    throw new ErrorException("ErrorException");

} catch (PDOException | ErrorException $exception) {

    echo '<pre>';
    var_dump($exception);
    echo '</pre>';

}catch (Exception $exception){
    echo "<p class='trigger error'>{$exception->getMessage()}</p>";
} finally {
    echo "<p class='trigger'>Execução terminou!</p>";
}

/*
 * [ php data object ] Uma classe PDO para manipulação de banco de dados.
 * http://php.net/manual/pt_BR/class.pdo.php
 */
fullStackPHPClassSession("php data object", __LINE__);

try {
    $pdo = new PDO(
            'mysql:host=localhost;dbname=fullstackphp',
            "luisitb",
            '$tr@wb3rry',
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ]
    );

    $stmt = $pdo->query("SELECT * FROM users LIMIT 5");
    while ($user = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo '<pre>';
        var_dump($user);
        echo '</pre>';
    }
} catch (Exception $exception) {
    echo '<pre>';
    var_dump($exception);
    echo '</pre>';
}

/*
 * [ conexão com singleton ] Conextar e obter um objeto PDO garantindo instância única.
 * http://br.phptherightway.com/pages/Design-Patterns.html
 */
fullStackPHPClassSession("conexão com singleton", __LINE__);

require __DIR__ . './source/autoload.php';

use Source\Database\Connect;

$pdo1 = Connect::getInstance();
$pdo2 = Connect::getInstance();

echo '<pre>';
var_dump(
    $pdo1,
    $pdo2,
    Connect::getInstance(),
    Connect::getInstance()::getAvailableDrivers(),
    Connect::getInstance()->getAttribute(PDO::ATTR_DRIVER_NAME)
);
echo '</pre>';