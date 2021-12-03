<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

$user_id = (isset($_GET['user_id']) && ctype_digit($_GET['user_id'])) ? $_GET['user_id'] : '';
$first_name = '';
$last_name = '';
$email = '';
$ml_ids = array();

if (!empty($user_id)) {
    $query = 'SELECT'
            . '`first_name`, `last_name`, `email` FROM'
            . '`ml_users` WHERE'
            . '`user_id` =' . $user_id;
    $result = mysql_query($query, $db)or die(mysql_error($db));

    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_assoc($result);
        extract($row);
    }
    mysql_free_result($result);

    $query = 'SELECT `ml_id` FROM `ml_subscriptions` WHERE `user_id` =' . $user_id;
    $result = mysql_query($query, $db)or die(mysql_error($db));

    while ($row = mysql_fetch_assoc($result)) {
        $ml_ids[] = $row['ml_id'];
    }
    mysql_free_result($result);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscrição Lista Discussão</title>
    </head>
    <body>
        <h1>Cadastre-se na lista discussão</h1>
        <form method="post" action="ml_user_transact.php">
            <table>
                <tr>
                    <td><label for="email">Endereço Email:</label></td>
                    <td><input type="email" name="email" id="email" value="<?php echo $email; ?>"/></td>
                </tr>
            </table>
            <p>Se você não é atualmente um membro, por favor fornecer o seu nome:</p>
            <table>
                <tr>
                    <td><label for="first_name">Primeiro Nome:</label></td>
                    <td><input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="last_name">Sobre Nome:</label></td>
                    <td><input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>"/></td>
                </tr>
            </table>
            <p>Selecione as listas de discussão que você deseja receber:</p>
            <p>
                <select name="ml_id[]" multiple="multiple">
                    <?php
                    $query = 'SELECT'
                            . '`ml_id`, `listname` FROM'
                            . '`ml_lists` ORDER BY'
                            . '`listname` ASC';
                    $result = mysql_query($query, $db)or die(mysql_error($db));

                    print_r($ml_ids);
                    while ($row = mysql_fetch_array($result)) {
                        if (in_array($row['ml_id'], $ml_ids)) {
                            echo '<option value="' . $row['ml_id'] . '" selected="selected">';
                        } else {
                            echo '<option value="' . $row['ml_id'] . '">';
                        }
                        echo $row['listname'] . '</option>';
                    }
                    mysql_free_result($result);
                    ?>
                </select>
            </p>
            <p><input type="submit" name="action" value="Subscribe" /></p>
        </form>
    </body>
</html>