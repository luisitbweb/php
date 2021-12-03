<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pode ou Não Dirigir</title>
    </head>
    <body>
        <?php
        $a = isset($_GET["ano"])?$_GET["ano"]:1900;
        $i = date("Y") - $a;
        echo "Você nasceu em $a e tem $i anos.<br/>";
        if($i < 16){
            $tipovoto = "Não Vota";
        }
        elseif(($i >= 16 && $i < 18)|| ($i > 65)){
                $tipovoto = "Voto Opcional<br/>";
            }
            else{
                $tipovoto = "Voto Obrigatorio<br/>";
            }
        echo "Para essa idade $tipovoto<br/>";
        ?>
        <a href="modelohtml.html">Voltar</a>
    </body>
</html>
