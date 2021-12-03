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
        <?php
        $txt = "Este é um exemplo de string gigante que...";
        $res = wordwrap($txt,5,"<br/>\n",TRUE);
        echo "$res";
        ?>
    </body>
</html>
