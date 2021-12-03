<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Utilizando Estrutura FOR</title>
    </head>
    <body>
        <?php
        $n = isset($_GET["num"])?$_GET["num"]:1;
        for($c = 1; $c <= 10; $c++){
            $r = $n * $c;
            echo "$n x $c = $r <br/>";
        }
        ?>
        <br/><a href="forhtml.php">Voltar</a>
    </body>
</html>
