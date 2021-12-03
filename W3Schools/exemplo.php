<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
fieldset#sexo{
    width: 220px;
}
</style>
</head>
<body> 

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Nome Obrigatorio!";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Somente letras e espaços permitidos."; 
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "e-mail Obrigatorio!";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Formato de e-mail Invalido!"; 
     }
   }
     
   if (empty($_POST["website"])) {
     $website = "";
   } else {
     $website = test_input($_POST["website"]);
     // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
     if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
       $websiteErr = "URL Invalida!"; 
     }
   }

   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }

   if (empty($_POST["gender"])) {
     $genderErr = "Sexo não Informado!";
   } else {
     $gender = test_input($_POST["gender"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* Campos Obrigatorios.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
    Nome: <input type="text" name="name" autofocus="autofocus">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   E-mail: <input type="email" name="email">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   Website: <input type="url" name="website">
   <span class="error"><?php echo $websiteErr;?></span>
   <br><br>
   Comentario: <textarea name="comment" rows="5" cols="40"></textarea>
   <br><br>
   Anexar Arquivo:<input type="file" name="name"/><br/>
   <fieldset id="sexo">
   <legend>Sexo:</legend>
   <label><input type="radio" name="gender" value="female">Feminino</label>
   <label><input type="radio" name="gender" value="male">Masculino</label>
   <span class="error">* <?php echo $genderErr;?></span>
   </fieldset>
   <br><br>
   <input type="submit" name="submit" value="Enviar"> <br/>
</form>

<?php
echo "<h2>Seus Dados:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>