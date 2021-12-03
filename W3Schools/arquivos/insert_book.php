<html>
<head>
    <title>Book-O-Rama Book Entry Results</title>
  </head>

<body>
  <h1> Book-O-Rama Book Entry Results</h1>

<?php
      //cria nome de varivel abreviado

$isbn = "isbn";
$author = "author";
$title = "title";
$price = "price";

if (!$isbn || !$author || !$title || !$price)
{
  echo 'You have not entered all the required details.<br />'
          .'please go back and try again.';
     exit;
}

$isbn = addslashes($isbn);
$author = addslashes($author);
$title = addslashes($title);
$price = doubleval($price);

@ $db = mysqli_pconnect('localhost', 'root', 'mother');
 
if (!$db)
{

  echo ' Erro: Could not connect to database. Please try again later.';
          exit;
}

mysqli_select_db('books');

$query = "insert * into books values
          ('".$isbn."', '".$author."', '".$title."', '".$price."')";

$result = mysqli_query($query);

if ($result)
    echo mysqli_affected_rows(). ' book insert into database.';

?>

  </body>
</html> 