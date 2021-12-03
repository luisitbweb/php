<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista Discussão Administrador</title>
        <style type="text/css">
            td{vertical-align: top;}
        </style>
    </head>
    <body>
        <h1>Lista Discussão Administrador</h1>
        <form method="post" action="ml_admin_transact.php">
            <p><label for="listname">Adicionar lista discussão:</label><br />
                <input type="text" id="listname" name="listname" maxlength="100" />
                <input type="submit" name="action" value="Add New Mailing List" />
            </p>
            <?php
            $query = 'SELECT'
                    . '`ml_id`, `listname` FROM'
                    . '`ml_lists` ORDER BY'
                    . '`listname` ASC';
            $result = mysql_query($query, $db)or die(mysql_error($db));

            if (mysql_num_rows($result) > 0) {
                echo '<p><label for="ml_id">Deleta Lista Discussão:</label><br />';
                echo '<select name="ml_id" id="ml_id">';
                while ($row = mysql_fetch_array($result)) {
                    echo '<option value="' . $row['ml_id'] . '"> ' . $row['listname'] . '</option>';
                }
                echo '</select> ';
                echo ' <input type="submit" name="action" value="Delete Mailing List" />';
                echo '</p>';
            }
            mysql_free_result($result);
            ?>
        </form>
        <p><a href="ml_quick_msg.php">Envie uma mensagem rápida para os usuários.</a></p>
        <p><a href="ml_purge.php">Deletar os usuários não confirmados?</a></p>
    </body>
</html>