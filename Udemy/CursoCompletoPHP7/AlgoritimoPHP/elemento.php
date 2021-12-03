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
        <div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset>
                    <legend>Cadastro</legend>
                    <p>Nome:</p>
                        <input type="text" name="nome"/>
                    <p>Email:</p>
                        <input type="email" name="email"/>
                    <p>Senha:</p>
                        <input type="password" name="senha"/>
                    <p>Website:</p>
                        <input type="text" name="website"/>
                    <p>Comentario:</p>
                        <textarea name="comment" rows="5" cols="40"></textarea>
                    <hr />
                        <fieldset>
                            <legend>Selecione o Sexo</legend>
                            <p><label><input type="radio" name="gender" value="Feminino"/>Feminino</label></p>
                            <p><label><input type="radio" name="gender" value="masculino"/>Masculino</label></p>
                        </fieldset><br>
                    <input type="submit" value="Enviar"/>
                </fieldset>
            </form>
            <?php
            // define varables and set to empty values
            $nome = $email = $gender = $comment = $website = $senha = "";
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $nome = test_input($_POST["nome"]);
                $email = test_input($_POST["email"]);
                $gender = test_input($_POST["gender"]);
                $comment = test_input($_POST["comment"]);
                $website = test_input($_POST["website"]);
                $senha = test_input($_POST["senha"]);
            }
            function test_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
        </div>
    </body>
</html>
