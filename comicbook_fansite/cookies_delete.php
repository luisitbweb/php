<?php
// Os cookies expirou em algum momento no passado
$expire = time() -1000;

setcookie('username', NULL, $expire);
setcookie('remember_me', NULL, $expire);

header('Refresh: 5; URL=cookies_test.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete teste cookies</title>
    </head>
    <body>
        <h1>Deletando Cookies</h1>
        <p>Você vai ser redirecionado para a pagina teste principal em 5 segundos.</p>
        <p>Se seu navegador não redirecionar você automaticamente, <a href="cookies_test.php">Clique aqui</a>.</p>
    </body>
</html>