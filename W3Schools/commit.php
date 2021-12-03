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

switch ($_GET['action']) {
    case 'Adicionar':
        switch ($_GET['type']) {
            case 'movie':
                $error = array();
                $moviename = isset($_POST['moviename']) ? trim($_POST['moviename']) : '';
                if (empty($moviename)) {
                    $error[] = urlencode('Por favor entre com nome do filme.');
                }
                $movie_type = isset($_POST['movie_type']) ? trim($_POST['movie_type']) : '';
                if (empty($movie_type)) {
                    $error[] = urlencode('Por favor selecione o tipo de filme.');
                }
                $movie_year = isset($_POST['movie_year']) ? trim($_POST['movie_year']) : '';
                if (empty($movie_year)) {
                    $error[] = urldecode('Por favor selecione o ano do filme.');
                }
                $movieleadactor = isset($_POST['movieleadactor']) ? trim($_POST['movieleadactor']) : '';
                if (empty($movieleadactor)) {
                    $error[] = urldecode('Por favor selecione o ator principal.');
                }
                $moviedirector = isset($_POST['moviedirector']) ? trim($_POST['moviedirector']) : '';
                if (empty($moviedirector)) {
                    $error[] = urldecode('Por favor selecione um diretor.');
                }
                $movie_release = isset($_POST['movie_release']) ? trim($_POST['movie_release']) : '';
                if(!preg_match('|^\d{2}-\d{2}-\d{4}$|', $movie_release)){
                    $error[] = urldecode('Por favor entre com data no formato dd-mm-yyyy.');
                }  else {
                    list($day, $month, $year) = explode('/', $movie_release);
                    if(!checkdate($month, $day, $year)){
                        $error[] = urldecode('Por favor entre com uma data valida.');
                    }  else {
                        $movie_release = mktime(0, 0, 0, $month, $day, $year);
                    }
                }
                $movie_rating = isset($_POST['movie_rating']) ? trim($_POST['movie_rating']) : '';
                if(!is_numeric($movie_rating)){
                    $error[] = urldecode('Por favor entre uma classificação numerica.');
                }elseif ($movie_rating < 0 || $movie_rating > 10) {
                    $error[] = urldecode('Por favor entre uma classificação entre 0 a 10.');
                }
                if (empty($error)) {
                    $query = 'insert into `movie`'
                            . '(`moviename`, `movie_year`, `movie_type`, `movieleadactor`, `moviedirector`, `movie_release`, `movie_rating`) values'
                            . '("' . $moviename . '",'
                            . '' . $movie_year . ','
                            . '' . $movie_type . ','
                            . '' . $movieleadactor . ','
                            . '' . $moviedirector . ','
                            . '' . $movie_release . ','
                            . '' . $movie_rating . ')';
                } else {
                    header('Location:movie.php?action=add' . '&error=' . join($error, urldecode('<br />')));
                }
            break;
        }
    break;
    case 'Editar':
        switch ($_GET['type']) {
            case 'movie':
                $error = array();
                $moviename = isset($_POST['moviename']) ? trim($_POST['moviename']) : '';
                if (empty($moviename)) {
                    $error[] = urldecode('Por favor entre com nome filme.');
                }
                $movie_type = isset($_POST['movie_type']) ? trim($_POST['movie_type']) : '';
                if (empty($movie_type)) {
                    $error[] = urldecode('Por favor selecione um tipo de filme.');
                }
                $movie_year = isset($_POST['movie_year']) ? trim($_POST['movie_year']) : '';
                if (empty($movie_year)) {
                    $error[] = urldecode('Por favor selecione o ano filme.');
                }
                $movieleadactor = isset($_POST['movieleadactor']) ? trim($_POST['movieleadactor']) : '';
                if (empty($movieleadactor)) {
                    $error[] = urldecode('Por favor selecione o ator principal.');
                }
                $moviedirector = isset($_POST['moviedirector']) ? trim($_POST['moviedirector']) : '';
                if (empty($moviedirector)) {
                    $error[] = urldecode('Por favor selecione um diretor.');
                }
                $movie_release = isset($_POST['movie_release']) ? trim($_POST['movie_release']) : '';
                if(!preg_match('|^\d{2}-\d{2}-\d{4}$|', $movie_release)){
                    $error[] = urldecode('Por favor entre com data no formato dd-mm-yyyy.');
                }  else {
                    list($day, $month, $year) = explode('/', $movie_release);
                    if(!checkdate($month, $day, $year)){
                        $error[] = urldecode('Por favor entre com uma data valida.');
                    }  else {
                        $movie_release = mktime(0, 0, 0, $month, $day, $year);
                    }
                }
                $movie_rating = isset($_POST['movie_rating']) ? trim($_POST['movie_rating']) : '';
                if(!is_numeric($movie_rating)){
                    $error[] = urldecode('Por favor entre uma classificação numerica.');
                }elseif ($movie_rating < 0 || $movie_rating > 10) {
                    $error[] = urldecode('Por favor entre uma classificação entre 0 a 10.');
                }
                if (empty($error)) {
                    $query = 'update `movie` set'
                            . 'moviename = "' . $moviename . '",'
                            . 'movie_year = "' . $movie_year . '",'
                            . 'movie_type = "' . $movie_type . '",'
                            . 'movieleadactor = "' . $movieleadactor . '",'
                            . 'moviedirector = "' . $moviedirector . '",'
                            . 'movie_release = "' .$movie_release . '",'
                            . 'movie_rating = "' .$movie_rating . 'where'
                            . 'movie_id = ' . $_POST['movie_id'];
                } else {
                    header('Location:movie.php?action=Editar&id=' . $_POST['movie_id'] . '&error=' . join($error, urldecode('<br />')));
                }
            break;
        }
    break;
}
if (isset($query)) {
    $result = mysql_fetch_assoc($result, $db) or die(mysql_error($db));
}
?>
<html>
    <head>
        <title>Enviando</title>
    </head>
    <body>
        <p><mark>Feito com Sucesso!</mark></p>
    </body>
</html>