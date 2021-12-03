<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CMS</title>
        <style type="text/css">
            td{vertical-align: top;}
        </style>
    </head>
    <body>
        <h1>Livro de quadrinho Avaliação</h1>
        <?php
        if (isset($_SESSION['name'])) {
            echo '<p>Você está atualmente logado como: ' . $_SESSION['name'] . '</p>';
        }
        ?>
    </div>
    <div id="navright">
        <form method="get" action="cms_search.php">
            <div>
                <label for="search">Pesquisar</label>
                <?php
                echo '<input type="text" id="search" name="search" ';
                if (isset($_GET['keywords'])) {
                    echo 'value="' . htmlspecialchars($_GET['keywords']) . '" ';
                }
                echo '/>';
                ?>
                <input type="submit" value="Search" />
            </div>
        </form>
    </div>
    <div id="navigation">
        <a href="cms_index.php">Artigo</a>
        <?php
        if (isset($_SESSION['user_id'])) {
            echo ' | <a href="cms_compose.php">Compor</a>';
            if ($_SESSION['access_level'] > 1) {
                echo ' | <a href="cms_pending.php">Revisão</a>';
            }
            if ($_SESSION['access_level'] > 2) {
                echo ' | <a href="cms_admin.php">Admin</a>';
            }
            echo ' | <a href="cms_cpanel.php">Painel de Controle</a>';
            echo ' | <a href="cms_transact_user.php?action=Logout">Sair</a>';
        } else {
            echo ' | <a href="cms_login.php">Login</a>';
        }
        ?>
    </div>
    <div id="articles">