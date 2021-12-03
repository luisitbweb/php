<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Connect MYSQl Server</title>
    </head>
    <body>
        <?php
        // connect.php connect to the mysql server

        try {
            $dsn = 'mysql:host=localhost;dbname=cookbook';
            $dbh = new PDO($dsn, 'luisitb', 'speak');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            print('<p>Conectado! </p>');
            // exit();
        } catch (PDOException $ex) {
            print('<p>Não pode conectar para servidor!!!</p>');
            print('<p>Code de Erro: ' . $ex->getCode() . '</p>');
            print('<p>Mensagem de Erro: ' . $ex->getMessage() . '</p>');
            exit();
        }
        $dbh = NULL;
        print('<p>Disconectado!!! </p>');
        try {
            $dsn = 'mysql:host=localhost;dbname=cookbook';
            $dbh = new PDO($dsn, 'luisitb', 'speak');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->query('SELECT');
        } catch (Exception $ex) {
            print('Não pode executar pequisa! <br />');
            print('Erro informação usando objeto exception: <br />');
            print('SQLSTATE valor:' . $ex->getCode() . '<br />');
            print('Erro Mensagem:' . $ex->getMessage() . '<br />');
            print('Erro informação usando base de dados manipulação: <br />');
            print('Codigo erro: ' . $dbh->errorCode() . '<br />');
            $errorInfo = $dbh->errorInfo();
            print('SQLSTATE valor: ' . $errorInfo[0] . '<br />');
            print('Numero erro: ' . $errorInfo[1] . '<br />');
            print('Mesagem erro: ' . $errorInfo[2] . '<br />');
        }

        class Cookbook {

            public static $host_name = 'localhost';
            public static $db_name = 'cookbook';
            public static $user_name = 'luisitb';
            public static $password = 'speak';

            public static function connect() {
                $dsn = 'mysql:host=' . self::$host_name . ';dbname=' . self::$db_name;
                $dbh = new PDO($dsn, self::$user_name, self::$password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return ($dbh);
            }

        }
        ?>
    </body>
</html>
