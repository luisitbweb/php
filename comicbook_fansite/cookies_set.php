<?php
// Os cookies podem expirar 30 dias a partir de agora (em segundos)
$expire = time() + (60 * 60 * 24 * 30);

setcookie('username', 'test_user', $expire);
setcookie('remember_me', 'yes', $expire);

header('Refresh: 5; URL=cookies_test.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste Cookies definido</title>
    </head>
    <body>
        <h1>Configuração Cookies</h1>
        <p>Você vai ser redirecionado para a pagina de teste principal em 5 segundos.</p>
        <p>Se seu navegador não redirecionar você automaticamente, <a style="text-decoration: none;" href="cookies_test.php">Clique aqui</a>.</p>
    </body>
</html>