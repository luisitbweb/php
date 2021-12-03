<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Visualizar teste cookies</title>
    </head>
    <body>
        <h1>Estes cookies são definidos</h1>
        <?php
            if(!empty($_COOKIE)){
                echo '<pre>';
                print_r($_COOKIE);
                echo '</pre>';
            }  else {
                echo '<p>Os cookies não estão definidos.</p>';
            }
        ?>
        <p><a href="cookies_test.php">Voltar para pagina teste principal</a></p>
    </body>
</html>