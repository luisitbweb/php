<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina Principal</title>
        <style>
            a{text-decoration: none;}
        </style>
    </head>
    <body>
        <h1>Bem vindo a pagina Principal!</h1>
        <?php
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
            // usuario esta logado em
            ?>
            <p>Obrigado por fazer login em nosso sistema, <b><?php echo $_SESSION['username']; ?>.</b></p>
            <p>Agora você pode <a href="user_personal.php">Clique aqui</a> para ir para o seu
                própria área de informações pessoais e atualizar ou remover suas informações devem
                você deseja fazê-lo.</p>
            <?php
            if ($_SESSION['admin_level'] > 0) {
                echo '<p><a href="admin_area.php"> Clique aqui </a> para acessar suas ferramentas administrativas.</p>';
            }
        } else {
            // usuario não esta logado em
            ?>
            <p>No momento você não está logado ao nosso sistema. Uma vez que você entrar,
                você terá acesso à sua área pessoal, juntamente com outro usuário informações.</p>
            <p>Se você já é cadastrado, <a href="login.php">Clique aqui</a> fazer login. Ou se você gostaria de criar uma conta, <a href="register.php">Clique aqui</a> para registrar.</p>
            <?php
        }
        ?>
    </body>
</html>