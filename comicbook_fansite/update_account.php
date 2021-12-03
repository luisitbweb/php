<?php
include_once 'auth.inc.php';
include_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

$hobbies_list = ['Computers', 'Dancing', 'Exercise', 'Flying', 'Golfing', 'Hunting', 'Internet', 'Reading', 'Traveling', 'Other than listed'];

if (isset($_POST['submit']) && $_POST['submit'] == 'Update') {
// preencher entrada valores
    $username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
    $user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';
    $first_name = (isset($_POST['first_name'])) ? trim($_POST['first_name']) : '';
    $last_name = (isset($_POST['last_name'])) ? trim($_POST['last_name']) : '';
    $email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
    $city = (isset($_POST['city'])) ? trim($_POST['city']) : '';
    $state = (isset($_POST['state'])) ? trim($_POST['state']) : '';
    $hobbies = (isset($_POST['hobbies']) && is_array($_POST['hobbies'])) ? $_POST['hobbies'] : array();

    $errors = array();

// certifique-se o username e user_id é um par válido nós não que as pessoas tentar manipular a forma de hackear conta de outra pessoa!

    $query = 'SELECT `username` FROM `site_user` WHERE'
            . '`user_id` = "' . (int) $user_id . '"AND `username` = "' . mysql_real_escape_string($_SESSION['username'], $db) . '"';
    $result = mysql_query($query, $db)or die(mysql_error($db));

    if (mysql_num_rows($result) == 0) {
        ?>

        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Atualizar informações da conta</title>
                <style type="text/css">
                    td{vertical-align: top;}
                </style>
                <script type="text/javascript">
                    window.onload = function () {
                        document.getElementById('cancel').onclick = goBack;
                    };
                    function goBack() {
                        history.go(-1);
                    }
                </script>
            </head>
            <body>
                <p><strong>Não tente sair do formulario!</strong></p>
                <?php
                mysql_free_result($result);
                mysql_close_db($db);
                die();
            }
            mysql_free_result($result);

            if (empty($first_name)) {
                $errors[] = 'Primeiro nome não pode esta em branco!';
            }
            if (empty($last_name)) {
                $errors[] = 'Segundo nome não pode esta em branco!';
            }
            if (empty($email)) {
                $errors[] = 'Endereço de email não pode esta em branco!';
            }

            if (count($errors) > 0) {
                echo '<p><strong style="color: #FF000;">Não é possível atualizar suas informações da conta.</strong></p>';
                echo '<p>Corrija o seguinte:</p>';
                echo '<ul>';
                foreach ($errors as $error) {
                    echo '<li>' . $error . '</li>';
                }
                echo '</ul>';
            } else {
                // Sem erros ao inserir as informações no banco de dados.

                $query = 'UPDATE `site_user_info` SET'
                        . '`first_name` ="' . mysql_real_escape_string($first_name, $db) . '",'
                        . '`last_name`  ="' . mysql_real_escape_string($last_name, $db) . '",'
                        . '`email`      ="' . mysql_real_escape_string($email, $db) . '",'
                        . '`city`       ="' . mysql_real_escape_string($city, $db) . '",'
                        . '`state`      ="' . mysql_real_escape_string($state, $db) . '",'
                        . '`hobbies`    ="' . mysql_real_escape_string($hobbies, $db) . '" WHERE'
                        . '`user_id`    =' . $user_id;
                mysql_query($query, $db)or die(mysql_error($db));
                mysql_close($db);
                ?>
                <p><strong>As informações da conta foi atualizado.</strong></p>
                <p><a href="user_personal.php">Clique aqui</a> para retornar para sua conta.</p>
                <?php
                die();
            }
        } else {
            $query = 'SELECT u.user_id, `first_name`, `last_name`, `email`, `city`, `state`, `hobbies` AS my_hobbies FROM'
                    . '`site_user` u JOIN `site_user_info` i ON u.user_id = i.user_id WHERE'
                    . '`username` ="' . mysql_real_escape_string($_SESSION['username'], $db) . '"';
            $result = mysql_query($query, $db)or die(mysql_error($db));
            $row = mysql_fetch_assoc($result);

            extract($row);
            $hobbies = explode(', ', $my_hobbies);

            mysql_free_result($result);
            mysql_close($db);
        }
        ?>
        <h1>Atualizando informações da conta</h1>
        <form action="update_account.php" method="post">
            <table>
                <tr>
                    <td>Nome usuario:</td>
                    <td><input type="text" value="<?php echo $_SESSION['username']; ?>" disabled="disabled"/></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" name="email" id="email" size="20" maxlength="50" value="<?php echo $email; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="first_name">Primeiro nome:</label></td>
                    <td><input type="text" name="first_name" id="first_name" size="20" maxlength="20" value="<?php echo $first_name; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="last_name">Sobre nome:</label></td>
                    <td><input type="text" name="last_name" id="last_name" size="20" maxlength="20" value="<?php echo $last_name; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="city">Cidade:</label></td>
                    <td><input type="text" name="city" id="city" size="20" maxlength="20" value="<?php echo $city; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="state">Estado:</label></td>
                    <td><input type="text" name="state" id="state" size="2" maxlength="2" value="<?php echo $state; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="hobbies">Passatempo / Intereses:</label></td>
                    <td><select name="hobbies[]" id="hobbies" multiple="multiple">
                            <?php
                            foreach ($hobbies as $hobby) {
                                if (in_array($hobby, $hobbies)) {
                                    echo '<option value="' . $hobby . '" selected="selected">' . $hobby . '</option>';
                                } else {
                                    echo '<option value="' . $hobby . '">' . $hobby . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
                        <input type="submit" name="submit" value="Update"/>
                        <input type="button" id="cancel" value="Cancel" onclick="history.go(-1)"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>