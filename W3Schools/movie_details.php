<?php
require '../comicbook_fansite/db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db('moviesite', $db);

function get_avg_review($db, $movie_id) {
    $query = 'SELECT'
            . '`review_rating` FROM'
            . '`reviews` WHERE'
            . '`review_movie_id` =' . $movie_id;
    $result = mysql_query($query, $db)or die(mysql_error($db));
    $total_reviews = mysql_num_rows($result);

    $current = 0;
    $odd = TRUE;
    while ($row = mysql_fetch_assoc($result)) {
        $current = $current + $row['review_rating'];
        $date = $row['review_date'];
        $name = $row['reviewer_name'];
        $comment = $row['review_comment'];
        $rating = generate_ratings($row['review_rating']);

        if ($odd) {
            echo '<tr style="background-color: #EEEEEE;">';
        } else {
            echo '<tr style="backgrond-color: #FFFFFF;">';
        }
        $odd = !$odd;
    }
    return $current / $total_reviews;
}

/*
  $movie_health = calculate_differences($row['movie_takings'], $row['movie_cost']);
  $average_review = get_avg_review($db, $_GET['movie_id']);
  $average_review = round($average_review, 2);
 */
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'review_date';
}

// recuperar visualizacao para esse filme
$query = 'SELECT'
        . '`review_movie_id`, `review_date`, `reviewer_name`, `review_comment`, `review_rating` FROM'
        . '`reviews` WHERE'
        . '`review_movie_id` ="' . $_GET['movie_id'] . '" ORDER BY "' . $sort . '"ASC';
$result = mysql_query($query, $db)or die(mysql_error($db));

// exibir a visualizacao
$mid = $_GET['movie_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detalhes e Análises</title>
    </head>
    <body>
        <div style="text-align: center;">
            <h2>$moviename</h2>
            <h3><em>Detalhes</em></h3>
            <table border='2' style="padding: 2px; width: 70%; margin-left: auto; margin-right: auto;">
                <?php
                $odd = TRUE;
                while ($row = mysql_fetch_assoc($result)) {
                    
                    $date = $row['review_date'];
                    $name = $row['reviewer_name'];
                    $comment = $row['review_comment'];
                    $rating = generate_ratings($row['review_rating']);

                    if ($odd) {
                        echo '<tr style="background-color: #EEEEEE;">';
                    } else {
                        echo '<tr style="backgrond-color: #FFFFFF;">';
                    }
                    $odd = !$odd;
                }
                ?>
                <tr>
                    <th style="width: 7em;"><a href="movie_details.php?movie_id=$mid&sort=review_date">Data</a></th>
                    <th style="width: 10em;"><a href="movie_details.php?movie_id=$mid&sort=reviewer_name">Critico</a></th>
                    <th><a href="movie_details.php?movie_id=$mid&sort=review_comment">Comentarios</a></th>
                    <th style="width: 5em;"><a href="movie_details.php?movie_id=$mid&sort=review_rating">Classificação</a></th>
                </tr>
                <tr>
                    <td><strong>Title</strong></td>
                    <td>$moviename</td>
                    <td><strong>Ano lançamento</strong></td>
                    <td>$movie_yar</td>
                </tr>
                <tr>
                    <td><strong>Diretor Filme</strong></td>
                    <td>$moviedirector</td>
                    <td><strong>Custo</strong></td>
                    <td>$$movie_cost</td>
                </tr>
                <tr>
                    <td><strong>Ator Principal</strong></td>
                    <td>$movieleadactor</td>
                    <td><strong>Takings</strong></td>
                    <td>$$movie_takings</td>
                </tr>
                <tr>
                    <td><strong>Temp Execução</strong></td>
                    <td>$movie_running_time</td>
                    <td><strong>Saude</strong></td>
                    <td>$movie_health</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><strong>Avaliação Média</strong></td>
                    <td>$average_review</td>
                </tr>
            </table>
        </div>
    </body>
</html>