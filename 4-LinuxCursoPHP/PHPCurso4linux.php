<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        /*
          echo "Olá mundo! <hr>";

          print "olá mundo, novamente! <hr>";

          //$variavel = '8';
          //$variavel += 4;
          //$variavel = $variavel + 1.3;
          //$variavel = 3 + '16 carros';
          $variavel = '3yens' + '4yens<hr>';

          $inteiro = 10;

          //$var = (boolean)$inteiro;
          $var = (float) $inteiro;
          //$var = (string) $inteiro;
          //$var = (array) $inteiro;
          //$var = (object) $inteiro;
          $var1 = (unset) $inteiro;
          //$var = (binary) $inteiro;

          echo $variavel . "<hr>";

          var_dump($var);

          $idade = 18;
          $carteirinha = TRUE;

          if($idade >= 18 && $carteirinha){
          echo 'Seja bem Vindo!';
          }else{
          echo 'Você não pode entrar!';
          }

          $ip = 3;

          if($ip % 2 == 0){
          echo 'O numero e Par!';
          }  else {
          echo 'O numero e Impar!';
          }

          echo '<hr>';

          $pi = 2;

          echo !($pi % 2)? "O numero e Par!" : "O numero e Impar!";

          echo '<hr>';

          $Tarefa = array (
          'juliana' => array ('Idade' => 34, 'Bairro' => 'Botafogo', 'Telefone' => 0192837465),

          'Rafaela' => array ('Idade' => 32, 'Bairro' => 'Tijuca', 'Telefone' => 0987654321),

          'Beatriz' => array ('Idade' => 31, 'Bairro' => 'Flamengo', 'Telefone' => 1234567890));

          foreach ($Tarefa as $nome => $Idade) {
          echo "<table style='border:1px;'><tr>$nome</tr>";
          foreach ($Idade as $bairro => $dados) {
          echo "<td>$bairro</td>";
          foreach ($dados as $tel => $telefone){
          echo "<td>$tel</td><td>$telefone</td></table>";
          }
          }
          }
          // syntax heredoc
          $value = <<< ABC
          This is the text that will be included in the value variable.
          ABC;
          echo $value;
         */

        //MySQL
        $host = 'localhost';
        $port = 3306;
        $user = 'luiscarlos';
        $pass = 'mother';

        @ $db = mysql_connect("$host:$port", $user, $pass);

        // cria banco de dados se nao existir
        //$query = 'CREATE DATABASE IF NOT EXISTS moviesite';
        //mysql_query($query, $db);
        // verificar banco selecionado
        mysql_select_db('moviesite', $db);
        /*
          // criar tabela movie
          $query = 'create table movie('
          . 'movie_id int unsigned not null auto_increment,'
          . 'moviename varchar(255) not null,'
          . 'movie_type int not null default 0,'
          . 'movie_year int unsigned not null default 0,'
          . 'movieleadactor integer unsigned not null default 0,'
          . 'moviedirector integer unsigned not null default 0,'
          . 'primary key(movie_id),'
          . 'key movie_type(movie_type, movie_year))'
          . 'engine=myisam';
          mysql_query($query, $db);

          // cria tabela movietype
          $query = 'create table moviedado('
          . 'moviedado_id int unsigned not null auto_increment,'
          . 'moviedadolabel varchar(100) not null,'
          . 'primary key(moviedado_id))'
          . 'engine=myisam';
          mysql_query($query, $db);

          // cria tabela people
          $query = 'create table people('
          . 'people_id int unsigned not null auto_increment,'
          . 'peoplefullname varchar(255) not null,'
          . 'peopleisactor int(1) unsigned not null default 0,'
          . 'peopleisdirector int(1) unsigned not null default 0,'
          . 'primary key(people_id))'
          . 'engine=myisam';
          mysql_query($query, $db);

          echo 'banco de dados criado com sucesso!<br />';

          // inserir dados tabela movie
          $query = 'insert into movie('
          . 'movie_id, moviename, movie_type, movie_year, movieleadactor, moviedirector) values'
          . '(1, "bruce almighty", 5, 2003, 1, 2),'
          . '(2, "office space", 5, 1999, 5, 6),'
          . '(3, "grand cayon", 2, 1991, 4, 3)';
          mysql_query($query, $db);

          //inserir dados tabela movietype
          $query = 'insert into moviedado('
          . 'moviedado_id, moviedadolabel) values'
          . '(1, "sci fi"),'
          . '(2, "drama"),'
          . '(3, "adventure"),'
          . '(4, "war"),'
          . '(5, "comedy"),'
          . '(6, "horror"),'
          . '(7, "action"),'
          . '(8, "kids")';
          mysql_query($query, $db);

          // inserir dados tabela people
          $query = 'insert into people('
          . 'people_id, peoplefullname, peopleisactor, peopleisdirector) values'
          . '(1, "jim carrey", 1, 0),'
          . '(2, "tom shadyac", 0, 1),'
          . '(3, "lawrence kasdan",0, 1),'
          . '(4, "kevin livingston", 1, 0),'
          . '(5, "ron kline", 1, 0),'
          . '(6, "mike judge", 0, 1)';
          mysql_query($query, $db);

          echo 'dados inseridos com sucesso!';
         * 

          // alterar a tabela filme para incluir execucao hora campo de custos e tomadas
          $query = 'alter table movie add column('
          . 'movie_running_time int unsigned null,'
          . 'movie_cost decimal(4,1) null,'
          . 'movie_takings decimal(4,1) null)';
          mysql_query($query, $db);

          // inserir agora dados dentro da tabela de filme para cada filme
          $query = 'update movie set'
          . 'movie_running_time = 101,'
          . 'movie_cost = 81,'
          . 'movie_takings = 242.6 where'
          . 'movie_id = 1';
          mysql_query($query, $db);

          $query = 'update movie set'
          . 'movie_running_time = 89,'
          . 'movie_cost = 10,'
          . 'movie_takings = 10.8 where'
          . 'movie_id = 2';
          mysql_query($query, $db);

          $query = 'update movie set'
          . 'movie_running_time = 134,'
          . 'movie_cost = null,'
          . 'movie_takings = 33.2 where'
          . 'movie_id = 3';
          mysql_query($query, $db);
         * 
         
        // levar o nome completo diretor pela id
        function get_director($director_id) {
            global $db;
            $query = 'select peoplefullname from'
                    . 'people where'
                    . 'people_id = ' . $director_id;
            $result = mysql_query($query, $db);
            $array = mysql_fetch_assoc($result);
            extract($array);
            return $people_fullname;
        }

        // levar o nome ator procurado e retornar o nome completo
        function get_leadactor($leadactor_id) {
            global $db;
            $query = 'select peoplefullname from'
                    . 'people where'
                    . 'people_id = ' . $leadactor_id;
            $result = mysql_query($query, $db);
            $array = mysql_fetch_assoc($result);
            extract($array);
            return $people_fullname;
        }

        // levar o tipo de um filme id e retornar a descricao contextual
        function get_movietype($type_id) {
            global $db;
            $query = 'select movietypelabel from'
                    . 'movietype where'
                    . 'movietype_id = ' . $type_id;
            $result = mysql_query($query, $db);
            $array = mysql_fetch_assoc($result);
            extract($array);
            return $movietype_lebel;
        }

        // funcao para calcular se um filme obteve um lucro, perda ou apenas quebro mesmo
        function calculate_differences($takings, $cost) {
            $difference = $takings - $cost;
            if ($difference < 0) {
                $color = 'red';
                $difference = '$' . abs($difference) . 'million';
            } elseif ($difference > 0) {
                $color = 'green';
                $difference = '$' . $difference . 'million';
            } else {
                $color = 'blue';
                $difference = 'broke even';
            }
            return '<span style="color:' . $color . ';">' . $difference . '</span>';
        }

        // recuperar informacoes
        $query = 'select `moviename`, `movie_year`, `movie_director`, `movieleadactor`, `movie_type`, `movie_running_time`, `movie_cost`, `movie_takings from`'
                . 'movie where'
                . 'movie_id = ' . $_GET['movie_id'];
        $result = mysql_query($query, $db);
        $array = mysql_fetch_assoc($result);
        $moviename = $array['moviename'];
        $moviedirector = get_director($array['moviedirector']);
        $movieleadactor = get_leadactor($array['movieleadactor']);
        $movie_year = $array['movie_year'];
        $movie_running_time = $array['movie_running_time'] . 'mins';
        $movie_takings = $array['movie_takings'] . 'million';
        $movie_cost = $array['movie_cost'] . 'million';
        $movie_health = calculate_differences($array['movie_takings'], $array['movie_cost']);
        
        echo <<<ENDHTML

        <div style='text-align: center;'>
        <h2> $movie_name </h2>
        <h3> <em> Details </em> </h3>
        <table cellpadding='2' cellspacing='2'
        style='width: 70%; margin-left: auto; margin-right: auto;'>
        <tr>
        <td> <strong> Title </strong> </td>
        <td> $movie_name </td>
        <td> <strong> Release Year </strong></td>
        <td> $movie_year </td>
        </tr> <tr>
        <td> <strong> Movie Director </strong> </td>
        <td> $movie_director </td>
        <td> <strong> Cost </strong> </td>
        <td> $$movie_cost </td>
        </tr> <tr>
        <td> <strong> Lead Actor </strong> </td>
        <td> $movie_leadactor </td>
        <td> <strong> Takings </strong> </td>
        <td> $$movie_takings </td>
        </tr> <tr>
        <td> <strong> Running Time </strong> </td>
        <td> $movie_running_time </td>
        <td> <strong> Health </strong> </td>
        <td> $movie_health </td>
        </tr>
        </table> </div>

ENDHTML;
         * 
         
        // criar a tabela comentarios
        
        $query = 'create table reviews('
                . 'review_movie_id int unsigned not null,'
                . 'review_date date not null,'
                . 'reviewer_name varchar(255) not null,'
                . 'review_comment varchar(255) not null,'
                . 'review_rating tinyint unsigned not null default 0,'
                . 'key(review_movie_id))'
                . 'engine=innodb';
        mysql_query($query, $db) or die(mysql_error($db));
        
        // inserir novos dados dentro da tabela comentarios
        
        $query = <<<endsql
                insert into reviews(
                review_movie_id, review_date, reviewer_name, review_comment, review_rating) values
                (1, "2008-09-23", "john doe", "i thought this was a great movie even though my girlfriend made me see it against my will.", 4),
                (1, "2008-09-23", "billy bob", "i liked eraserhead better.", 2),
                (1, "2008-09-28", "peppermint patty", "i wish I'd have seen it sooner!", 5),
                (2, "2008-09-23", "marvin martian", "this is my favorite movie. i didn't wear my flair to the movie but i loved it anyway.", 5),
                (3, "2008-09-23", "george b.", "i liked this movie, even though i thought it was an infromational video from my travel agent.", 3)
endsql;
        mysql_query($query, $db);
        echo 'atualizacao de dados enseridos com sucesso no banco filme!';
       
         * 
         */
        // funcao para gerar classificacoes
        function generate_ratings($ratings){
            $movie_rating = '';
            for($i = 0; $i < $ratings; $i++){
                $movie_rating .= '<img src="star.png" alt"star"/>';
            }
            return $movie_rating;
        }
        $movie_id = 2;
        // recuperar comentarios para esse filme
        $query = 'select'
                . '`veriew_movie_id`, `review_date`, `reviewer_name`, `review_comment`, `review_rating` from'
                . 'reviews where'
                . 'review_movie_id = ' . $movie_id .'order by'
                . 'review_date DESC';
        $result = mysql_query($query, $db) or die(mysql_errno($db));
        
        // ver os comentarios
        echo <<<endhtml
        <h3><em>reviews</em></h3>
        <table cellpadding='2' cellspacing='2' style="width: 90%; margin-left: auto; margin-right: auto;">
        <tr>
        <th style="width: 7em;">date</th>
        <th style="width: 10em;">reviewer</th>
        <th>comments</th>
        <th style="width: 5em;">rating</th>
        </tr>
endhtml;
        while ($row = mysql_fetch_assoc($result)){
            $date = $row['review_date'];
            $name = $row['reviewer_name'];
            $comment = $row['review_comment'];
            $rating = generate_ratings($row['review_rating']);
        
        echo
        '<tr>
        <td style="vertical-align: top; text-align: center;">$date</td>
        <td style="vertical-align: top;">$name</td>
                <td style="vertical-align: top;">$comment</td>
                <td style="vertical-align: top;">$rating</td>';
        }
        ?>    
    </body>
</html>