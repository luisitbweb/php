<?php
require "../vendor/autoload.php";

use CoffeeCode\Cropper\Cropper;
use Faker\Factory;

$faker = Factory::create("pt-BR");

$generate = false;

if ($generate) {
    for ($img = 0; $img < 3; $img++) {
        $faker->image("assets/images", 600, 300);
    }
}

$c = new Cropper("assets/images/cache");

For ($image = 1; $image < 4; $image++) {
    ?>
    <article>
        <h1>Image <?= $image; ?></h1>
        <img src="assets/images/<?= $image; ?> .jgp" alt="">
        <img src="<?= $c->make("assets/images/{$image}.jpg", "300", "300"); ?>" alt="">
        <img src="<?= $c->make("assets/images/{$image}.jpg", "300", "300"); ?>" alt="">
    </article>
    <?php
    
    //rotina de delete
    $c->flush("name image");
//    $c->flush();
}