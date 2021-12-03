<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caixa de Texto com PHP</title>
    </head>
    <body>
        <?php
        $v = isset($_GET["val"])?$_GET["val"]:1;
        echo "<h1>Calculo do Fatorial de: $v</h1>";
        $c = $v;
        $fat = 1;
        do{
            $fat = $fat * $c;
            $c--;
        }
        while ($c >= 1);
        echo "<h3>O Calculo do Fatorial e: $fat</h3>";
        ?>
        <br/><a href="caixa.html">Voltar</a>
    </body>
</html>
