<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$image = ImageCreateTrueColor(200, 50);
ImageFilledRectangle($image, 0, 0, 199, 49, 0xFFFFFF); // white
$size = 20;
$angle = 0;
$x = 20;
$y = 35;
$text_color = 0x000000; // black
$text = 'Hello PHP!';
$fontpath = __DIR__ . '/stocky/Charm-Regular.ttf';
ImageFTText($image, $size, $angle, $x, $y, $text_color, $fontpath, $text);
header('Content-type: image/png');
ImagePNG($image);

function ImageFTCenter($image, $size, $angle, $font, $text, $extrainfo = array()) {
    // find the size of the image
    $xi = imagesx($image);
    $yi = imagesy($image);

    // find the size of the text
    $box = imageftbbox($size, $angle, $font, $text, $extrainfo);

    $xr = abs(max($box[2], $box[4]));
    $yr = abs(max($box[5], $box[7]));

    // compute centering
    $x = intval(($xi - $xr) / 2);
    $y = intval(($yi - $yr) / 2);

    return array($x, $y);
}

list($x, $y) = ImageFTCenter($image, $size, $angle, $font, $text);
ImageFTText($image, $size, $angle, $x, $y, $fore, $font, $text);

function ImageStringCenter($image, $text, $font) {
    // font sizes
    $width = array(1 => 5, 6, 7, 8, 9);
    $height = array(1 => 6, 8, 13, 15, 15);

    // find the size of the image
    $xi = ImageSX($image);
    $yi = ImageSY($image);

    // find the size of the text
    $xr = $width[$font] * strlen($text);
    $yr = $height[$font];

    // compute centering
    $x = intval(($xi - $xr) / 2);
    $y = intval(($yi - $yr) / 2);

    return array($x, $y);
}

list($x, $y) = ImageStringCenter($image, $text, $font);
ImageString($image, $font, $x, $y, $text, $fore);

$w = 400;
$h = 75;
$image = imagecreatetruecolor($w, $h);
imagefilledrectangle($image, 0, 0, $w - 1, $h - 1, 0xFFFFFF);

$color = 0x000000; // black
$text = 'Pack my box with five dozen liquor jugs.';

for ($font = 1, $y = 5; $font <= 5; $font++, $y += 20) {
    list($x) = ImageStringCenter($image, $text, $font);
    ImageString($image, $font, $x, $y, $text, $color);
}