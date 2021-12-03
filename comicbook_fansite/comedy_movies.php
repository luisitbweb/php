<?php
require 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db('moviesite', $db);

// obiter seu ponto inicial para a pequisa no url
if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

// obiter o filme
$query = 'SELECT'
        . '`moviename`, `movie_year` FROM'
        . '`movie` ORDER BY'
        . '`moviename` LIMIT "' . $offset . '", 1';
$result = mysql_query($query, $db)or die(mysql_error($db));
$row = mysql_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $row['moviename']; ?></title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>Nome Filme</th>
                <th>Ano</th>
            </tr>
            <tr>
                <td><?php echo $row['moviename']; ?></td>
                <td><?php echo $row['movie_year']; ?></td>
            </tr>
        </table>
        <p>
            <a href="page.php?offset=0">Page 1</a>
            <a href="page.php?offset=1">Page 2</a>
            <a href="page.php?offset=2">Page 3</a>
        </p>
    </body>
</html>