<?php

@ $db = mysql_connect('localhost:3306', 'luiscarlos', 'mother');
@ mysql_select_db('moviesite');
@ mysql_query($query, $db) or die(mysql_error($db));

if (!isset($_GET['do']) || $_GET['do'] != 1) {
    switch ($_GET['type']) {
        case 'movie':
            echo 'Tem certeza de que deseja excluir este filme?<br />';
            break;
        case 'people':
            echo 'Tem certeza de que deseja excluir esta pessoa?<br />';
            break;
    }
    echo '<a href="' . $_SERVER['REQUEST_URI'] . '&do=1">Sim</a>';
    echo 'or <a href="admin.php">Não</a>';
} else {
    switch ($_GET['type']) {
        case 'people':
            $query = 'update movie set movieleadactor = 0 where'
                    . 'movieleadoctor = ' . $_GET['id'];
            $result = mysql_query($query, $db) or die(mysql_error($db));
            $query = 'delete from people where'
                    . 'people_id = ' . $_GET['id'];
            $result1 = mysql_query($query, $db) or die(mysql_error($db));
            ?>
            <p style="text-align: center;">A pessoa selecionada foi deletada!
                <a href="movie_index.php">Retornar para Inicio.</a></p>
            <?php

            break;
        case 'movie':
            $query = 'delete from movie where'
                    . 'movie_id = ' . $_GET['id'];
            $result2 = mysql_query($query, $db) or die(mysql_error($db));
            ?>
            <p style="text-align: center;">O filme selecionado foi deletado!
                <a href="movie_index.php">Retornar para o Inicio.</a></p>
            <?php

            break;
    }
}