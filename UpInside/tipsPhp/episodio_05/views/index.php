<?php

require "../vendor/autoload.php";

use CoffeeCode\Paginator\Paginator;
use Source\Models\Post;

$post = new Post();
$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);

//$paginator = new Paginator("https://serverweblocal/www/PHP/PHPStudy/UpInside/tipsPhp/episodio_05/views/?page=", "Página", ["Primeira Página", "Primeira"], ["Última Página", "Última"]);
$paginator = new Paginator("https://localhost/www/PHP/PHPStudy/UpInside/tipsPhp/episodio_05/views/?page=");
$paginator->pager($post->find()->count(), 3, $page, 2);

$posts = $post->find()->limit($paginator->limit())->offset($paginator->offset())->fetch(true);

echo "<link rel='stylesheet' type='text/css' href='assets/css/style.css' />";
echo "<p>Página {$paginator->page()} de {$paginator->pages()}</p>";

if($posts){
    foreach ($posts as $post){
        echo "<article class='post'><img src='{$post->cover}'/><div><h1>{$post->title}</h1><div>{$post->description}</div></div></article>";
    }
}

echo $paginator->render();