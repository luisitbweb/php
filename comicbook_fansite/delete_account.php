<?php
include_once 'auth.inc.php';
include_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

if (isset($_POST['submit']) && $_POST['submit'] == 'Yes') {
    $query = 'DELETE i FROM'
            . '`site_user` u JOIN `site_user_info` i ON u.user_id = i.user_id WHERE'
            . '`username` ="' . mysql_real_escape_string($_SESSION['username'], $db) . '"';
    mysql_query($query, $db)or die(mysql_error($db));

    $query = 'DELETE FROM `site_user` WHERE `username` ="' . mysql_real_escape_string($_SESSION['username'], $db) . '"';
    mysql_query($query, $db)or die(mysql_error($db));

    $_SESSION['logged'] = NULL;
    $_SESSION['username'] = NULL;
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Deletando Conta</title>
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
            <p><strong>A sua conta foi excluída.</strong></p>
            <p><a href="main.php">Clique aqui</a> para retornar para a pagina inicial.</p>
            <?php
            mysql_close($db);
            die();
        } else {
            ?>
            <p>Tem certeza de que deseja excluir a sua conta?</p>
            <p><strong>Não tem como recuperar a sua conta uma vez que você confirmar!</strong></p>
            <form action="delete_account.php" method="post">
                <div>
                    <input type="submit" name="submit" value="Yes"/>
                    <input type="button" id="cancel" value="No" onclick="history.go(-1);"/>
                </div>
            </form>
        </body>
    </html>

    <?php
}