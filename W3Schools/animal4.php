<?php
$head = $_POST['head'];
$body = $_POST['body'];
$tail = $_POST['tail'];

$image_dir = '<img alt="imagem" width="70" height="70" src="imagens/';

$head_image = imagecreatefromjpeg($image_dir . $head . '.jpg">');
$body_image = imagecreatefromjpeg($image_dir . $body . '.jpg">');
$tail_image = imagecreatefromjpeg($image_dir . $tail . '.jpg">');

// sua imagem esta 100px x 200px e onde picado horizontalmente
$new_animal = imagecreatetruecolor(300, 200);

// misturar a cabeça
imagecopymerge($new_animal, $head_image, 0, 0, 0, 0, 100, 200, 100);

// agora fundir corpo
imagecopymerge($new_animal, $body_image, 100, 0, 0, 0, 100, 200, 100);

// e finalmente a cauda
imagecopymerge($new_animal, $tail_image, 200, 0, 0, 0, 100, 200, 100);

header('Content-type: image/jpeg');
imagejpeg($new_animal);