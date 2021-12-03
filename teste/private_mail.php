<html>
<body>
<h1> Send Me Private Mail</h1>

<?php

 // talvez voce precise alterar essa linha, se nao utilizar
 // as portas padrao, 80 para trafego normal e 443 para ssl

 if($HTTP_SERVER_VARS['SEVER_PORT']!=443)

 echo '<p><font color="red">
  
    WARNING: you have not connected to this page using ssl.
    Your message could be read by others.</font></p>';

?>

<form method="post" action="send_private_mail.php"><br />
Your email address:<br />

<input type="text" name="from" size ="38"><br />
Subject:<br />
<input type="text" name="title" size="38"><br />
Your message:<br />
<textarea name="body" cols="30" rows="10">
</textarea><br />
<input type="submit" value="Send">
</form>
</body>
</html>