<?php
/* verifica se temos os dodos apropriados de variaveis
   as variaveis sao o texto e a cor do batao 
*/

$button_text = $HTTP_POST_VARS['button_text'];
$color = $HTTP_POST_VARS['color'];

if (empty($button_text) || empty($color))
{
 echo 'Could not create image - from not filled out correctly';
   exit;
}
  // cria uma imagem do fundo dereito e verifica o tamanho

$im = imagecreatefrompng ($color. "-button.png");

$width_imagem = ImageSX($im);
$height_image = ImageSY($im);

// nossas imagens precisam de uma margem de 18 de pixels a partir da borda da imagem

$sidth_image_wo_margins * $width_image - (2*18);
$height_image_wo_margins = $height_image - (2*18);

/* planeja se o tamanho da fonte se ajustara e o diminui ate se ajustar
inicia com o maior tamanho que se ajustara razoavelmente aos nossos botoes
*/

$font_size = 33;

// voce precisa informar a GD2 onde suas  fontes residem

putenv('GDFONTPATH =C:\winnt\Fonts');
$fontname = 'arial';

do
{
 $font_size--;

 // descobre o tamanho do texto nesse tamanho de fonte
$bbox=imagettfbbox($font_size, 0, $fontname, $button_text);

$right_text = $bbox[2]; // coordenada direita
$left_text = $bbox[0]; // coordenada esquerda
$width_text = $right_text - $left_text; // qual e sua largura
$height_text = abs($bbox[7] - $bbox[1]); // qual e sua altura
}

 while($font_size>8 &&
      ($height_text>$height_image_wo_margins ||
       $widht_text>width_image_wo_margins));

if ($height_text>height_image_wo_margins ||
    $width_text>$width_image_wo_margins)
{
 // nenhum tamanho de fonte legivel se ajustara no botao
 
 echo 'Text given will not fit on button.<br />';
}

 else
{
 /* localizamos um tamanho da fonte que se ajusta
agora planeja onde colocar
*/

$text_x = $width_image/2.0 - $width_text/2.0;
$text_y = $height_image/2.0 - $height_text/2.0;

if ($left_text < 0) {
        $text_x += abs($left_text);
    } // adiciona fator ao deslocamento esquerdo
   
   $above_line_text = abs($bbox[7]); // quanto acima da linha de base
   $text_y += $above_line_text; // adiciona fator de linha de base
   
   $text_y -= 2; // fator de ajustamento para forma do nosso exemplo
   
   $white = imagecolorallocate ($im, 255, 255, 255);

ImageTTFText ($im, $font_size, 0, $text_x, $text_y, $white, $fontname, $button_text);

header("content-type: image/png");

imagepng($im);
}
imagedestroy($im);
