<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Saudação</title>
    </head>
    <body>
        <?php
        date_default_timezone_get('America/Sao_Paulo');

        if (date('G') >= 5 && date('G') <= 11) {
            echo '<h1>Bom dia!</h1>';
        } elseif (date('G') >= 12 && date('G') <= 18) {
            echo '<h1>Boa Tarde!</h1>';
        } elseif (date('G') >= 19 && date('G') <= 4) {
            echo '<h1>Boa Noite!</h1>';
        }
        ?>
    </body>
</html>