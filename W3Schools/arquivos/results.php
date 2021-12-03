<html>
<head>
    <title>Book-O-Rama Search Results</title>
  </head>
<body>
  <h1> Book-O-Rama Search Results</h1>

<?php

  // cria nome de variavel abreviado

$searchtype = "searchtype";
$searchterm = "searchterm";

$searchterm= trim($searchterm);

if (!$searchtype || !$searchterm)
{
  echo 'You have not entered search details. Please go back and try again.';
        exit;
}

$searchtype = addslashes($searchtype);
$searchterm = addslashes($searchterm);

@ $db = mysqli_pconnect('localhost','root','mother');

if(!$db)
{
  echo 'Erro: Could not connect to database. Please try again later.';
         exit;
}

mysqli_select_db('books');

$query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
$result = mysqli_query($query);

$num_results = mysqli_num_rows($result);
echo '<p> Number of books found: '.$num_results.'</p>';

for ($i=0; $i <$num_results; $i++)
{
  //resultados do processo

  $rows = mysqli_fetch_array($result);
  echo '<p><strong>'.($i+1).'.Title: ';
  echo htmlspecialchars(stripslashes($rows['title']));
  echo '</strong><br />Author: ';
  echo stripslashes ($rows['author']);
  echo '<br />ISBN: ';
  echo stripslashes ($rows['isbn']);
  echo '<br />Preice: ';
  echo stripslashes($rows['price']);
  echo '</p>';
 }

?>
  
</body>
</html> 