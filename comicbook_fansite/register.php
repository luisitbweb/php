<?php
session_start();
include_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida!');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

$hobbies_list = ['Computers', 'Dancing', 'Exercise', 'Flying', 'Golfing', 'Hunting', 'Internet', 'Reading', 'Traveling', 'Other than listed'];

// filtro valores entrada
$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$first_name = (isset($_POST['first_name'])) ? trim($_POST['first_name']) : '';
$last_name = (isset($_POST['last_name'])) ? trim($_POST['last_name']) : '';
$email = (isset($_POST['email'])) ? trim($_POST['email']) : '';
$city = (isset($_POST['city'])) ? trim($_POST['city']) : '';
$state = (isset($_POST['state'])) ? trim($_POST['state']) : '';
$hobbies = (isset($_POST['hobbies']) && is_array($_POST['hobbies'])) ? $_POST['hobbies'] : array();

if (isset($_POST['submit']) && $_POST['submit'] == 'Register') {
    $errors = array();

    // tornam campos obrigatórios certeza que foram inseridos
    if (empty($username)) {
        $errors[] = 'Nome de usuario não pode estar em branco!';
    }
    // verificar se nome usuario ja foi registrado
    $query = 'SELECT `username` FROM `site_user` WHERE username = "' . $username . '"';
    $result = mysql_query($query, $db)or die(mysql_error($db));
    if (mysql_num_rows($result) > 0) {
        $errors[] = 'Nome usuario ' . $username . ' já esta registrado.';
        $username = '';
    }
    mysql_free_result($result);

    if (empty($password)) {
        $errors[] = 'Senha não pode esta em branco!';
    }
    if (empty($first_name)) {
        $errors[] = 'O primeiro nome não pode esta em branco!';
    }
    if (empty($last_name)) {
        $errors[] = 'Sobre nome não pode esta em branco!';
    }
    if (empty($email)) {
        $errors[] = 'Endereço de email não pode esta em branco!';
    }

    if (count($errors) > 0) {
        echo '<p><strong style="color:#FF000;"> Não e possivel fazer seu registro!</strong></p>';
        echo '<p>Por favor corrija o seguinte:</p>';
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
    } else {
        // Sem erros assim inserir as informações no banco de dados.

        $query = 'INSERT INTO `site_user`'
                . '(`user_id`, `username`, `password`) VALUES'
                . '(NULL, "' . mysql_real_escape_string($username, $db) . '", PASSWORD("' . mysql_real_escape_string($password, $db) . '"))';
        $result = mysql_query($query, $db)or die(mysql_error($db));

        $user_id = mysql_insert_id($db);

        $query = 'INSERT INTO `site_user_info`'
                . '(`user_id`, `first_name`, `last_name`, `email`, `city`, `state`, `hobbies`) VALUES'
                . '(' . $user_id . ','
                . '"' . mysql_real_escape_string($first_name, $db) . '",'
                . '"' . mysql_real_escape_string($last_name, $db) . '",'
                . '"' . mysql_real_escape_string($email, $db) . '",'
                . '"' . mysql_real_escape_string($city, $db) . '",'
                . '"' . mysql_real_escape_string($state, $db) . '",'
                . '"' . mysql_real_escape_string(join(', ', $hobbies), $db) . '")';
        $result = mysql_query($query, $db)or die(mysql_error($db));

        $_SESSION['logged'] = 1;
        $_SESSION['username'] = $username;

        header('Refresh: 5; URL=main.php');
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Registro</title>
                <style type="text/css">
                    td{vertical-align: top;}
                </style>
            </head>
            <body>
                <p><strong>Obrigado <?php echo $username; ?>Por registrar-se!</strong></p>
                <p>Seu registro esta completo! Você está sendo enviado para a página que você
                    Solicitou. Se seu navegador não redirecionar corretamente depois de 5 segundos, <a href="main.php">Clique aqui</a>.</p>
                <?php
                die();
            }
        }
        ?>
        <form action="register.php" method="post">
            <table>
                <tr>
                    <td><label for="username">Nome usuario:</label></td>
                    <td><input type="text" name="username" id="username" size="20" maxlength="20" value="<?php echo $username; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="password">Senha:</label></td>
                    <td><input type="password" name="password" id="password" size="20" maxlength="20" value="<?php echo $password; ?>"/></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email" size="20" maxlength="50" value="<?php echo $email; ?>"/></td>
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
                    <td><label for="hobbies">Passatempo:</label></td>
                    <td><select name="hobbies[]" id="hobbies" multiple="multiple">
                            <?php
                            foreach ($hobbies_list as $hobby) {
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
                    <td><input type="submit" name="submit" value="Register"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>