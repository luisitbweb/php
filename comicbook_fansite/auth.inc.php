<?php

// iniciar ou continuar seção
session_start();

if (!isset($_SESSION['logged'])) {
    header('Refresh: 5, URL=login.php?redirect=' . $_SERVER['PHP_SELF']);
    echo '<p>Você vai ser redirecionado para a pagina de login em 5 segundos.</p>';
    echo '<p>Se seu navegador não redirecionar você corretamente automaticamente, ' . '<a style="text-decoration: none;" href="login.php?redirect=' . $_SERVER['PHP_SELF'] . '">Clique aqui</a>.</p>';
    die();
}