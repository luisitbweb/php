<?php
// conexao banco dados MySQL
$host = 'localhost';
$port = 3306;
$base = 'moviesite';
$user = 'luiscarlos';
$pass = 'mother';

@ $db = mysql_connect("$host:$port", $user, $pass);
@ mysql_select_db($base, $db);

if (!$db) {
    echo '<mark> Erro: Não foi possível conectar ao banco de dados. Por favor tente de novo mais tarde ou chame o administrador. </mark>';
    exit;
}

if ($_GET['action'] == 'Editar') {
    // recuperando o registro informaçoes
    $query = 'select'
            . '`moviename`, `movie_type`, `movie_year`, `movieleadactor`, `moviedirector`, `movie_release`, `movie_rating`'
            . ' from `movie`'
            . 'where movie_id= 1'; //. $_GET['id'];
    $result = mysql_query($query, $db) or die(mysql_error($db));
    extract(mysql_fetch_assoc($result));
} else {
    // defina valores para espaco em branco
    $moviename = '';
    $movie_type = 0;
    $movie_year = date('Y');
    $movieleadactor = 0;
    $moviedirector = 0;
    $movie_release = time();
    $movie_rating = 5;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo ucfirst($_GET['action']); ?>Filme</title>
        <style type="text/css">
            <!--
            #error{background-color: #600; border: 1px solid #FF0; color: #FFF; text-align: center; margin: 10px; padding: 10px;}
            -->
        </style>
    </head>
    <body>
        <?php
        if (isset($_GET['error']) && $_GET['error'] != '') {
            echo '<div id="error">' . $_GET['error'] . '</div>';
        }
        ?>
        <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=movie" method="post">
            <table>
                <tr>
                    <td>Nome Filme</td>
                    <td><input type="text" name="moviename" value="<?php echo $moviename; ?>"/></td>
                </tr>
                <tr>
                    <td>Tipo Filme</td>
                    <td><select name="moviedado">
                            <?php
                            // seleciona o tipo informação do filme
                            $query = 'select `moviedado_id`, `moviedadolabel` from'
                                    . 'moviedado order by'
                                    . 'moviedadolabel';
                            $result = mysql_query($query, $db) or die(mysql_error($db));

                            // preencher a selecao opcoes com o resultado
                            while ($row = mysql_fetch_assoc($result)) {
                                foreach ($row as $value) {
                                    if ($row['movietype_id'] == $movie_type) {
                                        echo '<option value = "' . $row['movietype_id'] . '" selected="selected">';
                                    } else {
                                        echo '<option value ="' . $row['movietype_id'] . '">';
                                    }
                                    echo $row['movietypelabel'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ano Filme</td>
                    <td><select name="movie_year">
                            <?php
                            // preencher a selecao opcoes com o ano
                            for ($yr = date("Y"); $yr >= 1970; $yr--) {
                                if ($yr == $movie_year) {
                                    echo '<option value ="' . $yr . '"selected="selected">' . $yr . '</option>';
                                } else {
                                    echo '<option value="' . $yr . '">' . $yr . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Ator Principal</td>
                    <td><select name="movieleadactor">
                            <?php
                            // selecionar registro ator
                            $query = 'select `people_id`, `peoplefullname` from'
                                    . 'people where'
                                    . 'peopleisactor = 1 order by'
                                    . 'peoplefullname';
                            $result1 = mysql_query($query, $db) or die(mysql_error($db));

                            // preencher a selecao opcoes com o resultado
                            while ($row = mysql_fetch_assoc($result1)) {
                                foreach ($row as $value) {
                                    if ($row['people_id'] == $movieleadactor) {
                                        echo '<option value ="' . $row['people_id'] . '" selected="selected">';
                                    } else {
                                        echo '<option value="' . $row['people_id'] . '">';
                                    }
                                    echo $row['peoplefullname'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Diretor</td>
                    <td><select name="moviedirector">
                            <?php
                            // selecionar registro diretor
                            $query = 'select `people_id`, `peoplefullname` from'
                                    . 'people where'
                                    . 'peopleisdirector = 1 order by'
                                    . 'peoplefullname';
                            $result2 = mysql_query($query, $db) or die(mysql_error($db));

                            // preencher a selecao opcoes com o resultado
                            while ($row = mysql_fetch_assoc($result2)) {
                                foreach ($row as $value) {
                                    if ($row['people_id'] == $moviederector) {
                                        echo '<option value ="' . $row['people_id'] . '" selected="selected">';
                                    } else {
                                        echo '<option value="' . $row['people_id'] . '">';
                                    }
                                    echo $row['peoplefullname'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Data lançamento filme<br/>
                        <small>(dd-mm-yyyy)</small></td>
                    <td><input type="text" name="movie_release" value="<?php echo date('d-m-y', $movie_release); ?>"/></td>
                </tr>
                <tr>
                    <td>Classificação Filme<br/>
                        <small>(from 0 to 10)</small></td>
                    <td><input type="text" name="movie_rating" value="<?php echo $movie_rating; ?>"/></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <?php
                        if ($_GET['action'] == 'Editar') {
                            echo '<input type="hidden" value="' . $_GET['id'] . '" name="movie_id" />';
                        }
                        ?>
                        <input type="submit" name="submit" value="<?php echo ucfirst($_GET['action']); ?>"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>