<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Obrigado</title>
    </head>
    <body>
        <?php
            require_once 'db.inc.php';
            
            @ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
            @ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));
            
            $user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : '';
            $ml_id = (isset($_GET['ml_id'])) ? $_GET['user_id'] : '';
            $type = (isset($_GET['type'])) ? $_GET['type'] : '';
            
            if (empty($user_id)){
                die('Nenhum ID do usuário disponível.');
            }
            
            $query = 'SELECT `first_name`, `email` FROM `ml_users` WHERE `user_id` =' . $user_id;
            $result = mysql_query($query, $db)or die(mysql_error($db));
            
            if (mysql_num_rows($result) > 0){
                $row = mysql_fetch_assoc($result);
                $first_name = $row['first_name'];
                $email = $row['email'];
            }  else {
                die('Não id igual usuario.');
            }
            mysql_free_result($result);
            
            if (empty($ml_id)){
                die('Sem id disponivel lista discussão.');
            }
            
            $query = 'SELECT `listname` FORM `ml_lists` WHERE `ml_id` =' . $ml_id;
            $result = mysql_query($query, $db)or die(mysql_error($db));
            
            if (mysql_num_rows($result)){
                $row = mysql_fetch_assoc($result);
                $listname = $row['listname'];
            }  else {
                die('Não id igual lista discussão.');
            }
            mysql_free_result($result);
            
            if ($type == 'c'){
                echo '<h1>Obrigado ' . $first_name . '</h1>';
                echo '<p>Uma confirmação para inscrição para o ' . $listname . 'lista discussão foi enviada para ' . $email . '</p>';
            }  else {
                echo '<h1> Obrigado ' . $first_name . '</h1>';
                echo '<p>Obrigado por subscrever o ' . $listname . 'lista discussão.</p>';
            }
        ?>
    </body>
</html>