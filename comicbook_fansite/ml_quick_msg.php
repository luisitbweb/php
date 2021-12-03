<?php
require 'db.inc.php';
@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviando Mensagem</title>
        <style type="text/css">
            td{vertical-align: top;}
        </style>
    </head>
    <body>
        <h1>Enviando Mensagem</h1>
        <form method="post" action="ml_admin_transact.php">
            <table>
                <tr>
                    <td><label for="ml_id">Lista Discussão:</label></td>
                    <td><select name="ml_id" id="ml_id">
                            <option value="all">Tudo</option>
                            <?php
                            $query = 'SELECT `ml_id`, `listname` FROM `ml_lists` ORDER BY `listname`';
                            $result = mysql_query($query, $db)or die(mysql_error($db));

                            while ($row = mysql_fetch_array($result)) {
                                echo '<option value="' . $row['ml_id'] . '">' . $row['listname'] . '</option>';
                            }
                            mysql_free_result($result);
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="subject">Assunto:</label></td>
                    <td><input type="text" name="subject" id="subject"/></td>
                </tr>
                <tr>
                    <td><label for="message">Mensagem:</label></td>
                    <td><textarea name="message" id="message" rows="10" cols="60" style="resize: vertical;"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="action" value="Send Message"/></td>
                </tr>
            </table>
        </form>
        <p><a href="ml_admin.php">Voltar para lista discussão administrador.</a></p>
    </body>
</html>