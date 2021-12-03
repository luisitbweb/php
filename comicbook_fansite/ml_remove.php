<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Removendo Inscrição</title>
    </head>
    <body>
        <h1>Removendo Inscrição</h1>
        <?php
            require_once 'db.inc.php';
            
            @ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
            @ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));
            
            $user_id = (isset($_GET['user_id']) && ctype_digit($_GET['user_id'])) ? $_GET['user_id'] : -1;
            $ml_id = (isset($_GET['ml_id']) && ctype_digit($_GET['ml_id'])) ? $_GET['ml_id'] : '';
            
            if (empty($user_id) || empty($ml_id)){
                die('Parametros passados incorretamente.');
            }
            
            $query = 'DELETE FROM `ml_subscriptions` WHERE `user_id` =' . $user_id . 'AND `ml_id` =' . $ml_id;
            mysql_query($query, $db)or die(mysql_error($db));
            
            $query = 'SELECT `listname` FROM `ml_lists` WHERE `ml_id` =' .$ml_id;
            $result = mysql_query($query, $db)or die(mysql_error($db));
            if (mysql_num_rows($result) == 0){
                die('Lista desconhecida.');
            }
            
            $row = mysql_fetch_array($result);
            $listname = $row['listname'];
            mysql_free_result($result);
            
            echo '<p>Tiver sido removido do ' . $listname . ' lista discussão</p>';
            echo '<p><a href="ml_user.php?user_id=' . $user_id . '">Voltar para pagina Cadastro Lista Discussão.</a></p>';
        ?>
    </body>
</html>
