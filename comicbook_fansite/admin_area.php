<?php
include_once 'auth.inc.php';

if ($_SESSION['admin_level'] < 1) {
    header('Refresh: 5; URL= user_personal.php');
    echo '<p><strong>Você não esta autorizado para essa pagina.</strong></p>';
    echo '<p>Você esta sendo agora redirecionado para pagina principal.';
    echo '<p><strong>Se seu navegador não redirecionar você automaticamente, <a href="main.php">Clique aqui</a>.</p>';
    die();
}

include_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Area Administrador</title>
        <style type="text/css">
            th{background-color: #999;}
            .odd_row{background-color: #EEE;}
            .even_row{background-color: #FFF;}
        </style>
    </head>
    <body>
        <h1>Bem vindo a sua area administrador.</h1>
        <p>Aqui você pode ver e gerenciar outros usuarios.</p>
        <p><a href="main.php">Clique aqui</a> para retornar para a pagina principal.</p>
        <table style="width: 70%">
            <tr><th>Nome usuario</th><th>Primeiro nome</th><th>Sobre nome</th></tr>
            <?php
            $query = 'SELECT'
                    . '`u.user_id`, `username`, `first_name`, `last_name` FROM'
                    . '`site_user` JOIN `site_user_info` WHERE '
                    . 'site_user.user_id = site_user_info.user_id ORDER BY'
                    . '`username` ASC';
            $result = mysql_query($query, $db)or die(mysql_error($db));

            $odd = TRUE;
            while ($row = mysql_fetch_array($result)) {
                echo ($odd == TRUE) ? '<tr class="odd_row">' : '<tr class="even_row">';
                $odd = !$odd;
                echo '<td><a href="update_user.php?id=' . $row['user_id'] . '">' . $row['username'] . '</a></td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
                echo '</tr>';
            }
            mysql_free_result($result);
            mysql_close($db);
            ?>
        </table>
    </body>
</html>