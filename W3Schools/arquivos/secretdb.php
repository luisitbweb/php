<?php
  
 if (!isset($HTTP_POST_VARS['name'])&&!isset($HTTP_POST_VARS['password']))
{
   // o visitante precisa inserir um nome e uma senha
?>

  <h1> Please Log In </h1>
 This page is secret.
 
<form method="post" action="secretdb.php">
<table border="1">
<tr>
   <th> Username </th>
   <td><Input type="text" name="name"></td>
 </tr>
  <tr>
     <th> Password</th>
     <td><input type="Password" name="password"></td>
    </tr>
    <tr>
    <td colspan="2" align="center">
       <input type="submit" value="log In">
      </td>
     </tr>
  </table>
</form>

<?php
}
 else
{ 
  // conecta-se ao mySQL
     
     $hot = "localhost";
     $user = "dexter";
     $senha = 123456;
     $dba = "dexter";

$mysql = mysqli_connect($hot, $user, $senha);

if(!$mysql)
{
  echo 'Cannot connect to database.';
  exit;
}
  // selecione o banco de dados apropriado

$mysql = mysqli_select_db($dba);

if(!$mysql)
{
  echo 'Cannot select database.';
  exit;
}

  // consulta o banco de dos para ver se ha um registro correspondente

$query = "select count(*) from authorized_users where

name = $user and password = sha1($senha)";

$result = mysql_query($query);

if(!$result)
{
 echo 'Cannot run query.';
  exit;
}

 $count = mysql_result($result, 0,0);

if($count > 0)
{
  // a combinacao nome do visitante e senha esta correta

  echo '<h1> Here it is! </h1>';
  echo 'I bet you are glad you can see this secret page.';
}
  else
 {
  // a combinacao nome do visitante e senha esta incorreta
 
 echo '<h1> Go Away! </h1>';
 echo ' You are not authorized to view this resource.';
 
  }
 }
