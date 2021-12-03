<html>
    <body>
        <form action="processorder.php" method=post>
            <table border=0>
                <tr style="background-color:#ccccc">
                    <td width=100>Item</td>
                    <td width=15>Quantidade</td>
                </tr>
                <tr>
                    <td>Tires</td>
                    <td align="center"><input type="text" name="tireqty" size="3"
                                              maxlength="3"></td>
                </tr>
                <tr>
                    <td>Oil</td>
                    <td align="center"><input type="text" name="oilqty" size="3" maxlength="3"></td>
                </tr>
                <tr>
                    <td>Spark Plugs</td>
                    <td align="center"><input type="text" name="sparkqty" size="3"
                                              maxlength="3"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="submit Order"></td>
                </tr>
            </table>
        </form>

        <h1>Welcome to Bos's Auto Parts!</h1>

        <p>What Would you like to order today?</p>

        <h1>Bob's Auto Parts</h1>

        <p>Autor Luis Carlos Ultima Modificacao: 24 de Fevereiro.13:07 24/02/2015</p>

        <?php
        echo'<p>Order processed.</p>'; // inicia a impressao do pedido
        ?>

        <h2>Order Results</h2>

        <?php
        echo '<p>Order processed at ';
        echo date('H:i, jS F');
        echo '</p>';

        // cria nomes de variaveis abreiados

        $tireqty = 2;
        $oilqty = 3;
        $sparkqty = 4;

        echo '<p>Your order is as follows: </p>';
        echo $tireqty . ' tires<br />';
        echo $oilqty . ' bottles of oil<br />';
        echo $sparkqty . ' spark plugs<br />';

        $totalqty = 5;
        $tireqty = 7;
        $oilqty = 23;
        $sparkqty = 16;

        $totalqty = ($tireqty + $oilqty + $sparkqty);

        echo 'Items ordered: ' . $totalqty . '<br />';

        $totalamount = 0.00;

        define('tireprice', 100);
        define('oilprice', 10);
        define('sparkprice', 4);

        $totalamount = $tireqty * tireprice;
        + $oilqty * oilprice;
        + $sparkqty * sparkprice;

        echo 'Subtotal: $' . number_format($totalamount, 3) . '<br />';

        $taxrate = 0.10; // o imposto de vendas local e 10%
        $totalamount = $totalamount * (1 + $taxrate);

        echo 'total including tax: $' . number_format($totalamount, 2) . '<br />';

        $tireqty = $tireqty;

        if ($tireqty < 10) {
            $discount = 0;
        } elseif ($tireqty >= 10 && $tireqty <= 49) {
            $discount = 5;
        } elseif ($tireqty >= 50 && $tireqty <= 99) {
            $discount = 10;
        } elseif ($tireqty >= 100) {
            $discount = 15;
        }
        ?>
        <table style="border: 0">
            <tr>
                <td>How did you find bob's</td>
                <td><select name="find">
                        <option value = "a">I'm a regular customer
                        <option value = "b">TV advertising
                        <option value = "c">Phone directory
                        <option value = "d">word of mouth
                    </select>
                </td>
            </tr>
        </table>

        <?php
        echo '<font color=blue>';
        echo 'you did not order anything on the previous page!<br />';
        echo '</font>';
        ?>
        <table style="border:0; padding:3px">
            <tr>
                <td style="background-color:#cccccc; text-align:center">Distance</td>
                <td style="background-color:#cccccc; text-align:center">Cost</td>
            </tr>
        </table>

    </body>
</html>

<?php
$distance = 50;

while ($distance <= 250) {
    echo "<tr>\n <td align = 'right'>$distance</td>\n";
    echo "<td align = 'right'>" . $distance / 10 . "</td>\n</tr>\n";

    $distance += 50;
}