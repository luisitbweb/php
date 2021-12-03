<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
  $color = 0xFFFFFF;
  ImageColorTransparent($image, $color);

  // make a two-pixel thick black and white dashed line
  $style = array($black, $black, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT);
  ImageSetStyle($image, $style);

  $transparent = ImageColorsForIndex($image, ImageColorTransparent($image));
  print_r($transparent);


  // Overlaying Watermarks

  $image = ImageCreateFromPNG('/path/to/image.png');
  $stamp = ImageCreateFromPNG('/path/to/stamp.png');
  $margin = ['right' => 10, 'bottom' => 10]; // offset from the edge
  ImageCopy($image, $stamp, imagesx($image) - imagesx($stamp) - $margin['right'], imagesy($image) - imagesy($stamp) - $margin['bottom'], 0, 0, imagesx($stamp), imagesy($stamp));

  // Otherwise use ImageCopyMerge

  $image = ImageCreateFromPNG('/path/to/image.png');
  $stamp = ImageCreateFromPNG('/path/to/stamp.png');
  $margin = ['right' => 10, 'bottom' => 10]; // offset from the edge
  $opacity = 50; // between 0 and 100%
  ImageCopyMerge($image, $stamp, imagesx($image) - imagesx($stamp) - $margin['right'], imagesy($image) - imagesy($stamp) - $margin['bottom'], 0, 0, imagesx($stamp), imagesy($stamp), $opacity);
 * 
 */

$image = imagecreatefrompng(__DIR__ . 'image/iguana.jpg');

// Stamp
$w = 400;
$h = 75;
$stamp = ImageCreateTrueColor($w, $h);
imagefilledrectangle($image, 0, 0, $w - 1, $h - 1, 0xFFFFFF);

// attribution text
$color = 0x00000; // black
imagestring($stamp, 0, 10, 10, 'Galapagos Land Iguana by Nicolas de Camaret', $color);
ImageString($stamp, 4, 10, 28, 'http://flic.kr/ndecam/6215259398', $color);
ImageString($stamp, 2, 10, 46, 'Licence at http://creativecommons.org/licenses/by/2.0.', $color);

//add watermark
$margin = ['right' => 10, 'bottom' => 10]; // offset from the edge
$opacity = 50; // betwwen 0 and 100%
ImageCopyMerge($image, $stamp, imagesx($image) - imagesx($stamp) - $margin['right'], imagesy($image) - imagesy($stamp) - $margin['bottom'], 0, 0, imagesx($stamp), imagesy($stamp), $opacity);

// Send
header('Content-type: image/png');
ImagePNG($image);
ImageDestroy($image);
ImageDestroy($stamp);

// You want to create scaled-down thumbnail images

$fileName = __DIR__ . '/php.png';
$scale = 0.5; // scale
// images
$image = imagecreatefrompng($fileName);
$thumbnail = imagecreatetruecolor(imagesx($image) * $scale, imagesy($image) * $scale);

// preserve transparency
imagecolortransparent($thumbnail, imagecolorallocatealpha($thumbnail, 0, 0, 0, 127));
imagealphablending($thumbnail, FALSE);
imagesavealpha($thumbnail, TRUE);

// scale & copy
imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, imagesx($thumbnail), imagesy($thumbnail), imagesx($image), imagesy($image));

// send
header('Content-type: image/png');
imagepng($thumbnail);
imagedestroy($image);
imagedestroy($thumbnail);

// Rectangle Version

$filename = __DIR__ . '/php.png';
// Thumbnail Dimentions
$w = 50;
$h = 20;
// Images
$original = ImageCreateFromPNG($filename);
$thumbnail = ImageCreateTrueColor($w, $h);
// Preserve Transparency
ImageColorTransparent($thumbnail, ImageColorAllocateAlpha($thumbnail, 0, 0, 0, 127));
ImageAlphaBlending($thumbnail, false);
ImageSaveAlpha($thumbnail, true);
// Scale & Copy
$x = ImageSX($original);
$y = ImageSY($original);
$scale = min($x / $w, $y / $h);
ImageCopyResampled($thumbnail, $original, 0, 0, ($x - ($w * $scale)) / 2, ($y - ($h * $scale)) / 2, $w, $h, $w * $scale, $h * $scale);
// Send
header('Content-type: image/png');
ImagePNG($thumbnail);
ImageDestroy($original);
ImageDestroy($thumbnail);
