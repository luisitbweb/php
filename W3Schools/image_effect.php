<?php

// alterar este caminho para corresponder ao seu diretório de imagens
$dir = 'imagens';

// alterar este caminho para corresponder ao seu diretório de fontes e a fonte desejada 
putenv('GDFONTPATH=' . 'C:/Windows/Fonts');
$font = 'arial';

// certifique-se a imagem solicitada é válida

if (isset($_GET['id']) && ctype_digit($_GET['id']) && file_exists($dir . '/' . $_GET['id'] . '.jpg')) {
    $image = imagecreatefromjpeg($dir . '/' . $_GET['id'] . '.jpg');
} else {
    die('Imagem especificada invalida!');
}
// aplica o filtro
$effect = (isset($_GET['e'])) ? $_GET['e'] : -1;
switch ($effect) {
    case IMG_FILTER_NEGATE:
        imagefilter($image, IMG_FILTER_NEGATE);
        break;
    case IMG_FILTER_GRAYSCALE:
        imagefilter($image, IMG_FILTER_GRAYSCALE);
        break;
    case IMG_FILTER_EMBOSS:
        imagefilter($image, IMG_FILTER_EMBOSS);
        break;
    case IMG_FILTER_GAUSSIAN_BLUR:
        imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
        break;
}

// adiciona a legenda se solicitada
if (isset($_GET['capt'])) {
    imagettftext($image, 12, 0, 20, 20, 0, $font, $_GET['capt']);
}

// adiciona o logo marca d'agua se requerido
if(isset($_GET['logo'])){
    // determina posicao de x e y para centro marca d'agua
    list($width, $height) = getimagesize($dir . '/' . $_GET['id'] . '.jpg');
    list($wmk_width, $wmk_height) = getimagesize('imagens/logo.png');
    $x = ($width - $wmk_width) / 2;
    $y = ($height - $wmk_height) / 2;
    
    $wmk = imagecreatefrompng('imagens/logo.png');
    imagecopymerge($image, $wmk, $x, $y, 0, 0, $wmk_width, $wmk_height, 20);
    imagedestroy($wmk);
}
// mostra a imagem
header('Content-Type: image/jpeg');
imagejpeg($image, '', 100);
