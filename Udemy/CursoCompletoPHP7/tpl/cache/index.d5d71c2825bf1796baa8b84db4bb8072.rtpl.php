<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html>
    <head>
        <title>Template PHP</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Teste template PHP Udemy <?php echo htmlspecialchars( $name, ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>
        <p>Teste Udemy template</p>
        <p>Versão do PHP: <?php echo htmlspecialchars( $Version, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
    </body>
</html>