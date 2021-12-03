<?php
// filtra variaveis iniciais
$image_caption = (isset($_POST['image_caption'])) ? $_POST['image_caption'] : '';
$image_username = (isset($_POST['image_username'])) ? $_POST['image_username'] : 'Anonymous';
$destination = $_POST['destination'];
$image_tempname = $_FILES['image_filename']['name'];
$today = date('Y-m-d');

// alterar este caminho para corresponder ao seu diretório de imagens
$dir = 'imagens/';

$image_name = $dir . $image_tempname;

if (move_uploaded_file($_FILES['image_filename']['tmp_name'], $image_name)){
    // obter informacao sobre a imagem iniciando carregamento
    list($width, $height, $type, $attr) = getimagesize($image_name);
    
    if ($type != IMAGETYPE_JPEG){
        echo '<p><strong>Desculpa, mas o arquivo que voce carrego nao e JPG.<br /> Por favor volte e tente novamente.</strong></p>';
    }  else {
        // imagem esta incompativel para precesso
        $dest_image_name = $dir . $destination . '.jpg';
        
        $image = imagecreatefromjpeg($image_name);
        list($width2, $height2, $type2, $attr2) = getimagesize($dest_image_name);
        
        $image2 = imagecreatefromjpeg($dest_image_name);
        imagecopymerge($image2, $image, 0, 0, 0, 0, $width, $height, 100);
    }
    header('Content-type:image/jpeg');
    imagejpeg($image2);
}

$image_filename = 'images/AVATAR_03.jpg';
$image_caption = (isset($_POST['image_caption'])) ? $_POST['image_caption'] : ' ';
$length = strlen($image_caption);
$image = imagecreatefromjpeg($image_filename);

// desenhar um branco ellipse basico comprimento string
$white = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);

// o ponto central para a bolha no seu desenho animado esta nas cordenadas 134, 14 alterar esses valores para sua imagem especifica se necessario
$e_x = 134;
$e_y = 14;

// assumir cada personagem é 10px 10px mais em ambos os lados da corda para o coxim extra.
$e_width = ($length * 10) + 20;
$ellipse = imagefilledellipse($image, $e_x, $e_y, $e_width, 25, $white);

// obter ponto inicial para texto
$x = $e_x - (($length * 10) /2) - 10;
$y = $e_y + 5;

// local do texto na bolha
imagettftext($image, 12, 0, $x, $y, 0, 'arial.ttf', $image_caption);

header('Content-type: image/jpeg');
imagejpeg($image);