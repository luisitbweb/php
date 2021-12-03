<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Tabela de Frete Bob</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <table style="border: 0; padding: 3px">
                <tr>
                    <td style="background-color: #cccccc; text-align: center">Distancia</td>
                    <td style="background-color: #cccccc; text-align: center">Custo</td>
                </tr>
                <tr>
                    <td style="text-align: right">50</td>
                    <td style="text-align: right">5</td>
                </tr>
                <tr>
                    <td style="text-align: right">100</td>
                    <td style="text-align: right">10</td>
                </tr>
                <tr>
                    <td style="text-align: right">150</td>
                    <td style="text-align: right">15</td>
                </tr>
                <tr>
                    <td style="text-align: right">200</td>
                    <td style="text-align: right">20</td>
                </tr>
                <tr>
                    <td style="text-align: right">250</td>
                    <td style="text-align: right">25</td>
                </tr>
                <?php
                    $distancia = 50;
                    while($distancia <= 250){
                        echo "<tr>\n <td style='text-align: right'>$distancia</td>\n";
                        echo "<td style='text-align: right'>" . $distancia /10 . "</td>\n</tr>\n";
                        $distancia += 50;
                    }
                    echo '<p> Loop while!</p>';
                    for($distance = 50; $distance <= 250; $distance += 50){
                        echo "<tr>\n <td style='text-align: right'>$distance</td>\n";
                        echo "<td style='text-align: right'>" . $distance /10 . "</td>\n</tr>\n";
                    }
                    echo "<p> Loop for!</p>";
                ?>
            </table>
        </div>
    </body>
</html>