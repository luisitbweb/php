<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once './ImageFTCenter.php';

if (isset($_GET['button'])) {

// Configuration settings
    $image = imagecreatefrompng(__DIR__ . 'image'); // template image
    $size = 24;
    $angle = 0;
    $color = 0x000000;
    $fontFile = '/stocky/Charm-Regular.ttf'; // edit accordingly
    $text = $_GET['text']; // or any other source
// print-centered text
    list($x, $y) = ImageFTCenter($image, $size, $angle, $fontfile, $text);
    ImageFTText($image, $size, $angle, $x, $y, $color, $fontfile, $text);

// preserve transparency
    imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
    imagealphablending($image, FALSE);
    imagesavealpha($image, TRUE);

// send image
    header('Content-type: image/png');
    imagepng($image);

// clean up
    ImagePSFreeFont($font);
    imagedestroy($image);
} else {
    $url = htmlentities($_SERVER['PHP_SELF']);
    ?>

    <html>
        <head>
            <title>Sample Button Page</title>
        </head>
        <body>
            <img src="<?php echo $url; ?>?button=Previous" alt="Previous" width="132" height="46"/>
            <img src="<?php echo $url; ?>?button=Next" alt="Next" width="132" height="46"/>
        </body>
    </html>

    <?php
}