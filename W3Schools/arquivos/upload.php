<html>
    <head>
        <title> Uploading...</title>
    </head>
    <body>
        <h1> Uploading file...</h1>
        <?php
        if ($_FILES['userfiles']['error']) {
            echo 'Problem: ';
            switch ($_FILES['userfile']['error']) {
                case 1: echo 'File exceeded upload_max_filesize';
                    break;
                case 2: echo 'File exceeded upload_max_filesize';
                    break;
                case 3: echo 'File only partially uploaded';
                    break;
                case 4: echo 'No file uploaded';
                    break;
            }
            exit;
        }

        // o arquivo possui o tipo MINe correto?

        if ($_FILES['userfile']['type'] != 'text/plain') {
            echo 'Problem: file is not plain text';
            exit;
        }

        // insere arquivo onde gostariamos

        $upfile = 'C:\Apache24\uploads' . $_FILES['userfile']['name'];

        if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)) {
                echo 'Problem: Could not move file to destination directory';
                exit;
            }
        } else {
            echo 'Problem: possible file upload attack. Filename: ';
            echo $_FILES['userfile']['name'];
            exit;
        }

        echo 'File uploaded successfully<br><br>';

        // reformata o conteudo do arquivo

        $fp = fopen($upfile, 'r');
        $contents = fread($fp, filesize($upfile));
        fclose($fp);

        $contents = strip_tags($contents);
        $fp = fopen($upfile, 'w');
        fwrite($fp, $contents);
        fclose($fp);

// mostra o que foi carregado

        echo 'Preview of uploaded file contents:<br><hr>';
        echo $contents;
        echo '<br><hr>';
        ?>
    </body>
</html>