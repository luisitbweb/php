<?php
    require_once 'db.inc.php';
    require_once 'Class.SimpleMail.php';
    
    @ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
    @ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));
    
    $action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';
    
    switch ($action){
    case 'Subscribe':
        $email = (isset($_POST['email'])) ? $_POST['email'] : '';
        $query = 'SELECT `user_id`'
                . 'FROM `ml_users`'
                . 'WHERE `email` ="' . mysql_real_escape_string($email, $db) . '"';
        $result = mysql_query($query, $db)or die(mysql_error($db));
        
        if (mysql_num_rows($result) > 0){
            $row = mysql_fetch_assoc($result);
            $user_id = $row['user_id'];
        }  else {
            $first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
            $last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
            
            $query = 'INSERT INTO `ml_users`'
                    . '(`first_name`, `last_name`, `email`) VALUES'
                    . '("' . mysql_real_escape_string($first_name, $db) . '",'
                    . '"' . mysql_real_escape_string($last_name, $db) . '",'
                    . '"' . mysql_real_escape_string($email, $db) . '")';
            mysql_query($query, $db)or die(mysql_error($db));
            $user_id = mysql_insert_id($db);
        }
        mysql_free_result($result);
        
        foreach ($_POST['ml_id'] as $ml_id){
            if (ctype_digit($ml_id)){
                $query = 'INSERT INTO `ml_subscriptions`'
                        . '(`user_id`, `ml_id`, `pending`) VALUES'
                        . '(' . $user_id . ', ' . $ml_id . ', TRUE)';
                mysql_query($query, $db)or die(mysql_error($db));
                
                $query = 'SELECT `listname` FROM `ml_lists` WHERE `ml_id` =' . $ml_id;
                $result = mysql_query($query, $db)or die(mysql_error($db));
                
                $row = mysql_fetch_assoc($result);
                $listname = $row['listname'];
                
                $message = 'Ola ' . $first_name . "\n" .
                $message .= 'Nossos registros indicam que você se inscreveu para o' . $listname . ' lista discussão.' . "\n\n";
                $message .= 'Se você se inscreveu, por favor confirmar isto visitando o seguinte URL: http://localhost/NetBeans/PHP/comicbook_fansite/ml_user_transact.php?user_id=' . $user_id . '&ml_id=' . $ml_id . '&action=confirm';
                
                $mail = new SimpleMail();
                $mail->setToAddress($email);
                $mail->setFromAddress('luisitb@ig.com.br');
                $mail->setSubject('Confirmação lista discussão');
                $mail->setTextBody($message);
                $mail->send();
                unset($mail);
            }
        }
        header('Location: ml_thanks.php?user_id=' . $user_id . '&ml_id=' . $ml_id . '&type=c');
        break;
        
        case 'confirm':
            $user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : '';
            $ml_id = (isset($_GET['ml_id'])) ? $_GET['user_id'] : '';
            
            if (!empty($user_id) && !empty($ml_id)){
                $query = 'UPDATE `ml_subscriptions` SET'
                        . '`pending` = FALSE WHERE'
                        . '`user_id` =' . $user_id . ' AND `ml_id` =' . $ml_id;
                $result = mysql_query($query, $db)or die(mysql_error($db));
                
                $row = mysql_fetch_assoc($result);
                $listname = $row['listname'];
                mysql_free_result($result);
                
                $query = 'SELECT'
                        . '`first_name`, `email` FROM'
                        . '`ml_users` WHERE'
                        . '`user_id` =' . $user_id;
                $result = mysql_query($query, $db)or die(mysql_error($db));
                
                $row = mysql_fetch_assoc($result);
                $first_name = $row['first_name'];
                $email = $row['email'];
                mysql_free_result($result);
                
                $message = 'ola ' . $first_name . ',' . "\n";
                $message .= 'Obrigado por aceitar o ' . $listname . 'lista discussão. bem vindo!' . "\n\n";
                $message .= 'essa assinatura imediatamente, visitando o seguinte URL:' . "\n";
                $message .= 'http://localhost/NetBeans/PHP/comicbook_fansite/ml_remove.php?user_id=' . $user_id . '&ml_id=' . $ml_id;
                
                $mail = new SimpleMail();
                $mail->setToAddress('admin@example.com');
                $mail->setFromAddress('luisitb@ig.com.br');
                $mail->setSubject('Confirmar inscrição lista discussão');
                $mail->setTextBody($first_name . 'Apenas descrição para ' . $listname . '.');
                $mail->send();
                
                header('Location: ml_thanks.php?user_id=' . $user_id . '&ml_id=' . $ml_id . '&type=s');
            }  else {
                header('Location: ml_user.php');
            }
            break;
    }