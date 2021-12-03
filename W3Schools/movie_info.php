<?php
require 'db.inc.php';

function get_people_fullname($db, $people_id) {
    $query = 'SELECT'
            . '`peoplefullname` FROM'
            . '`people` WHERE'
            . '`people_id` = ' . $people_id;
    $result = mysql_query($query, $db)or die(mysql_error($db));
    $row = mysql_fetch_assoc($result);
    return $row['peoplefullname'];
}

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db('moviesite', $db);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Informações Filme</title>
    </head>
    <body>
        <table border='1'>
            <tr>
                <th>Nome Filme</th>
                <th>Ator Principal</th>
                <th>Diretor</th>
            </tr>
            <?php
            // obiter o filme
            $query = 'SELECT'
                    . '`moviename`, `movieleadactor`, `moviedirector` FROM'
                    . '`movie`';
            $result = mysql_query($query, $db)or die(mysql_error($db));

            while ($row = mysql_fetch_assoc($result)) {
                // calcular suas funcoes para obiter informacoes especificas
                $actor_name = get_people_fullname($db, $row['movieleadactor']);
                $director_name = get_people_fullname($db, $row['moviedirector']);

                // mostra linha tabela
                echo '<tr>';
                echo '<td>' . $row['moviename'] . '</td>';
                echo '<td>' . $actor_name . '</td>';
                echo '<td>' . $director_name . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </body>
</html>