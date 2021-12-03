<?php

/*
    To draw an arc, use ImageArc():
    ImageArc($image, $x, $y, $width, $height, $start, $end, $color);
    To draw an ellipse, use ImageEllipse():
    ImageEllipse($image, $x, $y, $width, $height, $color);
    To draw a circle, use ImageEllipse(), and use the same value for both $width and
    $height:
    ImageEllipse($image, $x, $y, $diameter, $diameter, $color);
 */

$styles = [IMG_ARC_PIE,
IMG_ARC_CHORD,
IMG_ARC_PIE | IMG_ARC_NOFILL,
IMG_ARC_PIE | IMG_ARC_NOFILL | IMG_ARC_EDGED];

/*
$size = 100;
$image = ImageCreateTrueColor($size, $size);
$background_color = 0xFFFFFF; // white
ImageFilledRectangle($image, 0, 0, $size - 1, $size - 1, $background_color);
$black = 0x000000;
ImageEllipse($image, $size / 2, $size / 2, $size - 1, $size - 1, $black);
ImageFilledEllipse($image, $size / 2, $size / 2, $size - 1, $size - 1, $black);

// $size = 100;
// $image = ImageCreateTrueColor($size * count($styles), $size);
$background_color = 0xFFFFFF; // white
ImageFilledRectangle($image, 0, 0,
$size * count($styles) - 1, $size * count($styles) - 1, $background_color);

// make a two-pixel thick black and white dashed line
$black = 0x000000;
$white = 0xFFFFFF;
$style = array($black, $black, $white, $white);
ImageSetStyle($image, $style);
ImageLine($image, 0, 0, 50, 50, IMG_COLOR_STYLED);
ImageFilledRectangle($image, 50, 50, 100, 100, IMG_COLOR_STYLED);

 */

$image = ImageCreateTrueColor(200, 50);
ImageFilledRectangle($image, 0, 0, 199, 49, 0xFFFFFF); // white
$size = 20;
$angle = 0;
$x = 20;
$y = 35;
$text_color = 0x000000; // black
$text = 'Hello PHP!';
$fontpath = __DIR__ . '/stocky/Charm-Bold.ttf';
ImageFTText($image, $size, $angle, $x, $y, $text_color, $fontpath,
$text);

// ImageString($image, 1, $x, $y, 'I love PHP Cookbook', $text_color);
// ImageFTText($image, $size, 0, $x, $y, $text_color, '/path/to/font.ttf', 'I love PHP Cookbook');

/*
for ($i = 0; $i < count($styles); $i++) {
ImageFilledArc($image, $size / 2 + $i * $size, $size / 2,
$size - 1, $size - 1, 0, 135, $black, $styles[$i]);
}
 */
header('Content-type: image/png');
ImagePNG($image);
ImageDestroy($image);