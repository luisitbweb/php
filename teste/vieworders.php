<?php
//cria nome de variavel abreviado
$VARS = 0;
$DOCUMENT_ROOT = $VARS['DOCUMENT_ROOT'];
?>

    <head>
        <title>Bob's Auto Parts - Encomendas dos Clientes</title>
    </head>
    <h1 style="text-align: center">Bob's Auto Parts</h1>
    <h2 style="text-align: center">Encomendas dos Clientes</h2>

        <?php
        // le arquivo inteiro.
        // cada pedido torna-se um elemento no array

        $orders = file("orders.txt");

        // conta o numero de pedidos no array

        $number_of_orders = count('$orders');

        if ($number_of_orders == 0) {
            echo '<p><strong>Sem pedidos pendentes.
                                Por favor tente de novo mais tarde.</strong></p>';
        }

        echo "<table width=100% border=5\n>
                <tr>
                    <th style='background-color: #ccccff; width: 120'> Order</th>
                    <th style='background-color: #ccccff; width: 65'> Tires</th>
                    <th style='background-color: #ccccff; width: 40'> Oil</th>
                    <th style='background-color: #ccccff; width: 70'> Spark Plugs</th>
                    <th style='background-color: #ccccff; width: 60'> Total</th>
                    <th style='background-color: #ccccff; width: 150'> address</th>
                </tr>";

        for ($i = 0; $i < $number_of_orders; $i++) {
            // divide cada linha
            
            echo $orders[$i]. '<br />';

            $line = explode($number_of_orders, $orders[$i]);

            //mantem somente o numero de itens encomendados

            $line[] = intval($line[0]);
            $line[] = intval($line[1]);
            $line[] = intval($line[2]);

            // envia cada pedido para a saida

            echo"<tr><td style='text-align: center'>     $line[0]</td>
                         <td style='text-align: center'> $line[1]</td>
                         <td style='text-align: center'> $line[2]</td>
                         <td style='text-align: center'> $line[3]</td>
                         <td style='text-align: center'> $line[4]</td>
                         <td> $line[5]</td>
                    </tr></table>";
        }

        $fp = fopen("orders.txt", 'r');

        flock($fp, LOCK_SH); // bloqueia para leitura

        if (!$fp) {
            echo '<p><strong>Sem pedidos pendentes.'
            . 'Por favor tente de novo mais tarde.</strong></p>';
            exit;
        }

        while (!feof($fp)) {
            $order = fgets($fp, 999);
            echo $order . '<br />';
        }

        flock($fp, LOCK_UN); // libera bloqueio de leitura

        fclose($fp);    