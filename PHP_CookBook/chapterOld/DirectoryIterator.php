<?php

//header("Content-Type: text/html5; charset=utf-8");
$path = 'D:\Apache24\htdocs\NetBeans\PHP\PHP_CookBook';
$conteudo = new DirectoryIterator($path);
foreach ($conteudo as $chave => $valor){
    echo '<pre>';
    echo "$chave | $valor -> {$valor->getPathname()}</br>";
}