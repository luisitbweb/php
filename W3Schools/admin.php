<?php
@ $db = mysql_connect('localhost:3306', 'luiscarlos', 'mother');
@ mysql_select_db('moviesite');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Banco de dados Filme</title>
        <style>
            th{background-color: #999;}
            .odd_row{background-color: #EEE;}
            .even_row{background-color: #FFF;}
            a{text-decoration: none;}
        </style>
    </head>
    <body>
        <table style="width: 100%;">
            <tr>
                <th colspan="2">Filmes<a href="movie.php?action=adicionar">[Adicionar]</a></th>
            </tr>
            <?php
            $query = 'select * from movie';
            $result = mysql_query($query, $db) or die(mysql_errno($db));
            $odd = TRUE;
            while ($row = mysql_fetch_assoc($result)) {
                echo ($odd == TRUE) ? '<tr class="odd_row">' : '<tr class="even_row">';
                $odd = !$odd;
                echo '<td style="width: 75%;">';
                echo $row['moviename'];
                echo '</td><td>';
                echo '<a href="movie.php?action=Editar&id=' . $row['movie_id'] . '">[Editar]</a>';
                echo '<a href="delete.php?type=movie&id=' . $row['movie_id'] . '">[Deletar]</a>';
                echo '</td></tr>';
            }
            ?>
            <tr>
                <th colspan="2">Pessoa<a href="people.php?action=Adicionar">[Adicionar]</a></th>
            </tr>
            <?php
            $query = 'select * from people';
            $result = mysql_query($query, $db) or die(mysql_errno($db));
            $odd = TRUE;
            while($row = mysql_fetch_assoc($result)){
            echo ($odd == TRUE) ? '<tr class="odd_row">' : '<tr class="even_row">';
            $odd = !$odd;
            echo '<td style="width: 25%;">';
            echo $row['peoplefullname'];
            echo '</td><td>';
            echo '<a href="people.php?action=edit&id=' . $row['people_id'] . '">[Editar]</a>';
            echo '<a href="delete.php?type=people&id=' . $row['people_id'] . '">[Deletar]</a>';
            echo '</td></tr>';
            }
            ?>
        </table>
    </body>
</html>