<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudo estrutura switch</title>
    </head>
    <body>
        <?php
        $n = isset($_GET["num"]) ? $_GET["num"] : 0;
        $o = isset($_GET["oper"]) ? $_GET["oper"] : 1;
        
    switch ($o){
        case 1:
            $r = $n * 2;
        echo "O resultado da Operação Dobro de $n Solicitada foi: $r";
            break;
        case 2:
            $r = $n * $n * $n;
        echo "O resultado da Operação Cubo de $n Solicitada foi: $r";
            break;
        case 3:
            $r = \sqrt($n);   
        echo "O resultado da Operação Raiz Quadrada de $n Solicitada foi: $r";
        }
        ?>
        <br/><a href="estruturaswitch.html">Voltar</a>
    </body>
</html>
