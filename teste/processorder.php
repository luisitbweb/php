<?php
require_once('file_exceptions.php');

// cria nomes de variaveis curtos.

$tireqty = $_POST["tireqty"];
$oilqty = $_POST["oilqty"];
$sparkqty = $_POST["sparkqty"];
$address = $_POST["address"];

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>

<html>
    <head>
        <title>Bob's Auto Parts - Resultado das Encomendas</title>
    </head>
    <body>
        <h1>Bob's Auto Parts</h1>
        <h2>Resultado das Encomendas</h2>

        <?php
        $date = date('H:i, jS F');

        echo "<p>Ordem de processamento. ";
        echo $date;
        echo "</p>";

        echo "<p>Sua ordem é a seguinte:$DOCUMENT_ROOT</p>";

        $totalqty = 0;
        $totalqty = $tireqty + $oilqty + $sparkqty;
        echo "Ordem Itens: $totalqty <br />";

        if ($totalqty == 0) {
            echo "Você não fez ordem nem uma na pagina anterior!<br />";
        } else {
            if ($tireqty > 0) {
                echo $tireqty . "Pneus<br />";
            }

            if ($oilqty > 0) {
                echo $oilqty . "Garrafas de óleo<br />";
            }

            if ($sparkqty > 0) {
                echo $sparkqty . "Velas de Ignição<br />";
            }
        }

        $totalamount = 0.00;

        define("tireprice", '100');
        define("oilprice", '10');
        define("sparkprice", '4');

        $totalamount = $tireqty * tireprice
                        + $oilqty * oilprice
                        + $sparkqty * sparkprice;

        $totalamount = number_format($totalamount, 2, '.', '');

        echo "<p>Total de ordens: $totalamount</p>";
        echo "<p>Endereço para entrega: $address</p>";

        $outputstring = $date . "\t" . $tireqty . "tires \t" . $oilqty . "oil\t"
                . $sparkqty . "spark plugs\t\$" . $totalamount . "\t" . $address . "\n";

// abre o arquivo para anexar 

        try {
            if (!($fp = @fopen("orders.txt", 'a+'))) {
                throw new fileOpenException();
            }

            if (!flock($fp, LOCK_EX)) {
                throw new fileLockException();
            }

            if (!fwrite($fp, $outputstring, strlen($outputstring))) {
                throw new fileWriteException();
            }
            flock($fp, LOCK_UN);
            fclose($fp);
            
            echo '<p><strong>A ordem não pôde ser aberta.'
            . 'Entre em contato com o nosso administrador para obter ajuda.</strong></p>';
            
        } catch (Exception $e) {
            echo '<p><strong> Seu pedido não pôde ser processado neste momento.'
            . 'Por favor tente de novo mais tarde.</strong></p>';
        }

        if (!$fp) {
            echo '<p><strong> Seu pedido não pôde ser processado neste momento.'
            . 'Por favor tente de novo mais tarde.</strong></p>';
            exit;
        }

        fwrite($fp, $outputstring, strlen($outputstring));

        fclose($fp);

        echo "<p>Ordem escrita.</p>";
        ?>
    </body>
</html>