<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title><?= $title; ?></title>

        <link rel="stylesheet" href="<?= url("../assets/css/style.css"); ?>"/>
    </head>
    <body>
        <header>
            <nav class="main_nav">
                <?php
                if ($v->section("sidebar")):
                    echo $v->section("sidebar");
                else:
                    ?>
                <a title="" href="<?= url(); ?>">Home</a>
                <a title="" href="<?= url("contato"); ?>">Contato</a>
                <a title="" href="<?= url("teste"); ?>">Teste</a>
                <?php endif; ?>
            </nav>
        </header>

        <main class="main_content">
            <?= $v->section("content"); ?>
        </main>

        <footer class="main_footer">
            <?= SITE;?> - Todos os Direitos Reservados.
        </footer>
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <?= $v->section("scripts"); ?>
    </body>
</html>