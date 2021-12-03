<?php
//MySQL
$host = 'localhost';
$port = 3306;
$user = 'luiscarlos';
$pass = 'mother';

@ $db = mysql_connect("$host:$port", $user, $pass);
@ mysql_select_db('moviesite', $db);

// alterar este caminho para corresponder ao seu diretório de imagens
$dir = 'imagens';

// alterar este caminho para corresponder ao seu diretório de miniaturas
$thumbdir = $dir . '/thumbs';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bem vindo a sua galeria de Fotos!</title>
        <style>
            th{background-color: #999;}
            .odd_row{background-color: #EEE;}
            .even_row{background-color: #FFF;}
        </style>
    </head>
    <body>
        <p>Clique em qualquer imagem para ver tamanho completo.</p>
        <table style="width: 100%;">
            <tr>
                <th>Image</th>
                <th>Legenda</th>
                <th>Carregado Por</th>
                <th>Data Carregamento</th>
            </tr>
            <?php
            // obter o galeria
            $result = mysql_query('SELECT * FROM `images`') or die(mysql_error());

            $odd = TRUE;

            while ($rows = mysql_fetch_array($result)) {
                echo ($odd == TRUE) ? '<tr class="odd_row">' : '<tr class="even_row">';
                $odd = !$odd;
                extract($rows);
                echo '<td><a href="' . $dir . '/' . $image_id . '.jpg">';
                echo '<img src="' . $thumbdir . '/' . $image_id . '.jpg">';
                echo '</a></td>';
                echo '<td>' . $image_caption . '</td>';
                echo '<td>' . $image_username . '</td>';
                echo '<td>' . $image_date . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </body>
</html>