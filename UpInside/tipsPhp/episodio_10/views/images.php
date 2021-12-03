<?php
require "../vendor/autoload.php";

$uploadDir = 'storage';

$upload = new \CoffeeCode\Uploader\Image($uploadDir, "images");
//$upload = new \CoffeeCode\Uploader\File($uploadDir, "media");
//$upload = new \CoffeeCode\Uploader\Media($uploadDir, "media");
//$upload = new \CoffeeCode\Uploader\Send($uploadDir, "media", []);

$files = $_FILES;

if (!empty($files["image"])) {
    $file = $files["image"];

    if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
        echo "<p>Selecione uma imagem valida</p>";
    } else {
        $uploaded = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 350);
        echo "<img src='{$uploaded}'/>";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <h1>Single Image: </h1>
    <input type="file" name="image"/>
    <button>Enviar</button>
</form>

<?php
if (!empty($files["images"])) {
    $images = $files["images"];

    for ($i = 0; $i < count($images["type"]); $i++) {
        foreach (array_keys($images) as $keys) {
            $imageFiles[$i][$keys] = $images[$keys][$i];
        }
    }
    foreach ($imageFiles as $file) {
        if (empty($file["type"])) {
            echo "<p>Selecione uma imagem valida</p>";
        } elseif (!in_array($file["type"], $upload::isAllowed())) {
            echo "<p>O arquivo {$file["name"]} não é valido</p>";
        } else {
            $uploaded = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 350);
            echo "<img src='{$uploaded}'/>";
        }
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <h1>More Images: </h1>
    <input type="file" accept="image/jpeg, image/jpg, image/png" name="images[]" multiple/>
    <button>Enviar</button>
</form>