<?php

require "../vendor/autoload.php";

$uploadDir = 'storage';

$upload = new \CoffeeCode\Uploader\Media($uploadDir, "medias");
//$upload = new \CoffeeCode\Uploader\File($uploadDir, "media");
//$upload = new \CoffeeCode\Uploader\Media($uploadDir, "media");
//$upload = new \CoffeeCode\Uploader\Send($uploadDir, "media", []);

$files = $_FILES;

if (!empty($files["file"])) {
    $file = $files["file"];

    if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
        echo "<p>Selecione uma Midia valida</p>";
    } else {
        $uploaded = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 350);
        echo "<a href='{$uploaded}'>Acessar Midia</a>";
    }
}

$sended = filter_input(INPUT_GET, "sended", FILTER_VALIDATE_BOOLEAN);
if($sended && empty($files["file"])){
    echo "Selecione uma Midia de até " . ini_get("upload_max_filesize");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <h1>Send Media:</h1>
    <input type="file" accept="audio/mp3, audio/mpeg, video/mp4" name="file"/>
    <button>Enviar</button>
</form>