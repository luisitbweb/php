<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Pagina Inicial</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="_css/home.css"/>        
        <script type="application/x-javascript" src="_JavaScript/Layout.js"></script>
    </head>
    <body>
        <div id="inface">
            
        <?php
        require('header.inc');
        ?>
        <?php
        require('menu.inc');
        ?>
        
        <aside id="cra">
            <p>Conteudo Relacionado aside</p>
        </aside>
        
        <section id="cs">
            <div id="ola"> <h3 id="mundo">Olá Mundo!</h3></div>
            <input type="checkbox" onclick="ola(this)" checked />Mostra rotação 180º graus!<br />
            
            <header id="ca">
                <p>Cabeçalho do Article</p>
            </header>
            
            <article id="ar">
                <p>Article</p>
            </article>
            
            <footer id="ra">
                <p>Rodape do Article</p>
            </footer>
        </section>
            <article id="al">
                <p>Article lateral</p>
            </article>
                    
                    <?php
                    require('footer.inc');
                    ?>
            </div>
    </body>
</html>
