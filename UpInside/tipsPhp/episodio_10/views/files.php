<?php

require "../vendor/autoload.php";

$uploadDir = 'storage';

$upload = new \CoffeeCode\Uploader\File($uploadDir, "files");
//$upload = new \CoffeeCode\Uploader\File($uploadDir, "media");
//$upload = new \CoffeeCode\Uploader\Media($uploadDir, "media");
//$upload = new \CoffeeCode\Uploader\Send($uploadDir, "media", []);

$files = $_FILES;

if (!empty($files["file"])) {
    $file = $files["file"];

    if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
        echo "<p>Selecione uma Arquivo valida</p>";
    } else {
        $uploaded = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 350);
        echo "<a href='{$uploaded}'>Acessar Arquivo</a>";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <h1>Send File:</h1>
    <input type="file" accept="application/pdf" name="file"/>
    <button>Enviar</button>
</form>