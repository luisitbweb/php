<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estudo de Funcão</title>
    </head>
    <body>
        <div>
            <?php
             function soma(){
                 $p = func_get_args();
                 $t = func_num_args();
                 $s = 0;
                 for($i=0; $i<$t; $i++){
                     $s += $p[$i];
                 }
                 return $s;
             }
             $r = soma(3, 2, 5, 8, 9);
             echo "A Soma dos valores e: $r";
            ?>
        </div>
    </body>
</html>