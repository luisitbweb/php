<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Exercio</title>
    </head>
    <body>
        <pre>
        <?php
        $str = array("morango" => "vermelho", "banana" => "amarela");
        //echo "O morango e ".$str{"morango"}."<br/>";
                 $first = $str["banana"];
        //echo " A banana e ".$first."<br/>";
        
        echo "O morango e ".$str{"morango"}."<br/>";
        //$first = $str["banana"];
        //$first(strlen($first)-1) = "a";
        echo "A banana e ".$first."<br/>";
        print_r($str);
        var_dump($str);
        
        ?>
        </pre>
    </body>
</html>
