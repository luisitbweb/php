<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario Universal</title>
        <style>
            td{vertical-align: top;}
        </style>
    </head>
    <body>
        <?php
        if ($_POST['type'] == 'movie') {
            echo '<h1>Novo ' . ucfirst($_POST['movie_type']) . ': ';
        } else {
            echo '<h1>Novo ' . ucfirst($_POST['type']) . ': ';
        }
        echo $_POST['name'] . '</h1>';
        echo'<table>';
        if ($_POST['type'] == 'movie') {
            echo '<tr>';
            echo '<td>Ano</td>';
            echo '<td>' . $_POST['year'] . '</td>';
            echo '</tr><tr>';
            echo '<td> Descrição Filme:</td>';
        } else {
            echo '<tr><td>Biografia:</td>';
        }
        echo '<td>' . nl2br($_POST['extra']) . '</td>';
        echo '</tr>';
        echo '</table>';
        if (isset($_POST['debug'])) {
            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
        }
        ?>
        <a href="form4.php">Voltar</a>
    </body>
</html>
