<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Poderes</title>
        <style type="text/css">
            td{vertical-align: top;}
            a{text-decoration: none;}
        </style>
    </head>
    <body>
        <img src="imagens/faviconkonami.jpg" alt="Site de Avaliação do livro de quadrinhos" style="float: left;" />
        <h1>Livro de Quadrinhos <br /> Avaliação</h1>
        <h2>Editar Caracteristicas de Poderes</h2>
        <hr style="clear: both;"/>
        <form action="char_transaction.php" method="post">
            <div>
                <input type="text" name="new_power" size="20" maxlength="40" value="" />
                <input type="submit" name="action" value="Add New Power" />
            </div>
            <?php
            require_once 'db.inc.php';

            @ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die('Conecção não estabelecida. Verifique seus parametros.');
            @ mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

            $query = 'SELECT `power_id`, `power` FROM `comic_power` ORDER BY `power` ASC';
            $result = mysql_query($query, $db) or die(mysql_error($db));

            if (mysql_num_rows($result) > 0) {
                echo '<p><em> A exclusão de um poder irá remover sua associação com qualquer caracteristica como bom escolha com sabedoria! </em></p>';

                $num_powers = mysql_num_rows($result);
                $threshold = 5;
                $max_columns = 2;
                $num_columns = min($max_columns, ceil($num_powers / $threshold));
                $count_per_column = ceil($num_powers / $num_columns);

                $i = 0;
                echo '<table><tr><td>';
                while ($row = mysql_fetch_assoc($result)) {
                    if (($i > 0) && ($i % $count_per_column == 0)) {
                        echo '</td><td>';
                    }
                    echo '<input type="checkbox" name"powers[]" value="' . $row['power_id'] . '" />';
                    echo $row['power'] . '<br />';
                    $i++;
                }
                echo '</td></tr></table>';
                echo '<br /><input type="submit" name="action" value="Deletar seleção Poderes" />';
            } else {
                echo '<p><strong>Não entrou com poderes...</strong></p>';
            }
            ?>
        </form>
        <p><a href="list_characters.php">Retornar para Pagina Principal.</a></p>
    </body>
</html>