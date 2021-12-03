<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * You want to extract metainformation from an image file. This lets you find out when
 * the photo was taken, the image size, and the MIME type
 */

$filename = 'image/iguana.jpg';
$exif = exif_read_data($filename);
echo '<pre>';
print_r($exif);

$thumb = exif_thumbnail($filename, $width, $height, $type);

if($thumb !== FALSE){
    $mine = image_type_to_mime_type($type);
    header("Content-type: $mine");
    print $thumb;
    
}elseif ($thumb !== FALSE) {
    $img = "<img src=\"$file\" alt=\"Beth and Seth\"width=\"$width\" height=\"$height\">";
    
    print $img;
} else {
    print 'Sorry. No thumbnail.';
}