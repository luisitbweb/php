<?php
include_once 'auth.inc.php';
include_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Informações Pessoais</title>
    </head>
    <body>
        <h1>Bem vindo a sua area de informações pessoais!</h1>
        <p>Aqui você pode atualizar suas informações pessoais, ou deletar sua conta.</p>
        <p>Suas informações como sua conta tem-se mostrado abaixo.</p>
        <p><a style="text-decoration: none;" href="main.php">Clique aqui</a> Para retornar para a pagina principal.</p>
        <?php
            $query = 'SELECT '
                    . '`username`, `first_name`, `last_name`, `city`, `state`, `email`, `hobbies` FROM'
                    . '`site_user` u JOIN '
                    . '`site_user_info` i ON u.user_id = i.user_id WHERE'
                    . '`username` = "' . mysql_real_escape_string($_SESSION['username'], $db) . '"';
            $result = mysql_query($query, $db)or die(mysql_error($db));
            
            $row = mysql_fetch_array($result);
            extract($row);
            mysql_free_result($result);
            mysql_close($db);
        ?>
        <ul>
            <li>Primeiro nome: <?php echo $first_name; ?></li>
            <li>Sobre nome: <?php echo $last_name; ?></li>
            <li>Cidade: <?php echo $city; ?></li>
            <li>Estado: <?php echo $state; ?></li>
            <li>Email: <?php echo $email; ?></li>
            <li>Passatempo / intereses: <?php echo $hobbies; ?></li>
        </ul>
        <p><a style="text-decoration: none;" href="update_account.php">Atualizar conta</a> || <a style="text-decoration: none;" href="delete_account.php">Deletar conta</a></p>
    </body>
</html>