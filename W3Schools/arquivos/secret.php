<?php
   // cria nomes abreviados para variaveis

@ $name = $HTTP_POST_VARS['name'];
@ $password = $HTTP_POST_VARS['password'];

if (empty($name) || empty($password))
{
   // o visitante precisa inserir um nome e uma senha

?>

     <h1> Please log IN</h1>

This page is secret.

<from method="post" action="secret.php">
<table border="1">
<tr>
    <th> Username</th>
    <td><input type="text" name="name"></td>
    </tr>
    <tr>
       <th> Password</td>
       <td><input type="password" name="password"></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" value="Log In">
        </td>
      </tr>
   </table>
</form>

<?php
}
 else if ($name=='user'&&$password=='pass')
{
  // a combinacao nome do visitante e senha esta correta
 
  echo '<h1> Here it is!</h1>';
  echo 'I bet you are glad you can see this secret page.';
}
 else
{
  // a combinacao nome do visitante e senha esta incorreta

    echo '<h1> Go Away"</h1>';
    echo ' You are not authorized to view this resource.';
}
?>