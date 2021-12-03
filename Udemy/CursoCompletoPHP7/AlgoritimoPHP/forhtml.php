<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Utilizando Estrutura FOR</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <form method="get" action="for.php">
                <select name="num">
                    <?php
                        for($c = 1; $c <= 10; $c++){
                        echo "<option>$c</option>";
                        }
                        ?>
                 </select>
                <br/><br/><input type="submit" value="Tabuada"/>
            </form>
        </div>
    </body>
</html>