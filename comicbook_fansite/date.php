<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quantos dias neste mês?</title>
    </head>
    <body>
        <?php
        date_default_timezone_get('America/Sao_Paulo');

        $month_name = date('F-Y');
        echo '<p>O mês é ' . $month_name . '.</p>';

        echo '<p>Tem ';
        $month = date('n');

        if ($month == 1) {
            echo '31';
        }
        else if ($month == 2) {
            echo '28 (a menos que seja um ano bissexto)';
        }
        else if ($month == 3) {
            echo '31';
        }
        else if ($month == 4) {
            echo '30';
        }
        else if ($month == 5) {
            echo '31';
        }
        else if ($month == 6) {
            echo '30';
        }
        else if ($month == 7) {
            echo '31';
        }
        else if ($month == 8) {
            echo '31';
        }
        else if ($month == 9) {
            echo '30';
        }
        else if ($month == 10) {
            echo '31';
        }
        else if ($month == 11) {
            echo '30';
        }
        else if ($month == 12) {
            echo '31';
        }

        echo ' Dias neste Mês.</p>';
        
        $months_left = 12 - $month;
        echo '<p>Tem ' . $months_left . ' meses para acabar o ano.</p>';
        ?>
    </body>
</html>