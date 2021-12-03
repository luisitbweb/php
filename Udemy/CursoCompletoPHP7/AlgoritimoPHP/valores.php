<!DOCTYPE html>

<html>

    <head>

        <meta charset="UTF-8">

        <title>Passagem de valor method get</title>

    </head>

    <body>
        <div>

            <?php
            $a = $_GET['vala'];
            $b = $_GET['valb'];
            $m = ($a + $b) / 2;
            $ab = sqrt($b);

            echo " O valor A = $a e B = $b";
            echo "<br/><br/> A soma vale: " . ($a + $b);
            echo "<br/><br/> A subtração vale: " . ($a - $b);
            echo "<br/><br/> A multiplicação vale: " . ($a * $b);
            echo "<br/><br/> A divisão vale: " . ($a / $b);
            echo "<br/><br/> O resto da divisão vale: " . ($a % $b);
            echo "<br/><br/> A media vale: $m";
            echo "<br/><br/> O valor Absoluto: " . abs($ab);
            echo "<br/><br/> O valor de $a<sup>$b</sup> e: " . pow($a, $b);
            echo "<br/><br/> A raiz de $a e: " . sqrt($a);
            echo "<br/><br/> O valor arrendondado de $ab e: " . round($ab);
            echo "<br/><br/> A parte inteira de $a e: " . intval($a);
            echo "<br/><br/> O valor de $b em Moeda e R$: " . number_format($b, 2, ",", ".");
            ?>

            <br/><br/><a href="valores.html">Voltar</a>

        </div>
    </body>

</html>