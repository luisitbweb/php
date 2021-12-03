<?php
session_start();

include_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

// filtrar valores de entrada
$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'main.php';

if (isset($_POST['submit'])) {
    $query = 'SELECT `admin_level` FROM `site_user` WHERE'
            . '`username` = "' . mysql_real_escape_string($username, $db) . '" AND '
            . '`password` = PASSWORD("' . mysql_real_escape_string($password, $db) . '")';
    $result = mysql_query($query, $db)or die(mysql_error($db));

    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['logged'] = 1;
        $_SESSION['admin_level'] = $row['admin_level'];
        header('Refresh: 5; URL=' . $redirect);
        echo '<p>Você vai ser redirecionado para sua pagina original solicitada.</p>';
        echo '<p>Se seu navegador não redirecionar você corretamente automaticamente, <a style="text-decoretion: none;" href="' . $redirect . '">Clique aqui</a></p>';
        die();
    } else {
        // definir explicitamente estes só para ter certeza
        
        $_SESSION['username'] = '';
        $_SESSION['logged'] = 0;
        $_SESSION['admin_level'] = 0;
        $error = '<p><strong>Você forneceu um nome de usuario ou senha invalido!</strong> Por favor <a style="text-decoretion: none;" href="register.php">Clique aqui</a>' . ' para registrar se você não tiver feito isso.</p>';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td>Usuario:</td>
                    <td><input type="text" name="username" maxlength="20" size="20" value="<?php echo $username; ?>" /></td>
                </tr>
                <tr>
                    <td>Senha:</td>
                    <td><input type="password" name="password" maxlength="20" size="20" value="<?php echo $password; ?>"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="redirect" value="<?php echo $redirect; ?>"/>
                        <input type="submit" name="submit" value="Login"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>