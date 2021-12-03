<?php
//MySQL
$host = 'localhost';
$port = 3306;
$user = 'luiscarlos';
$pass = 'mother';

@ $db = mysql_connect("$host:$port", $user, $pass);
@ mysql_select_db('moviesite', $db);

// alterar este caminho para corresponder ao seu diretório de imagens
$dir = 'imagens';

// alterar este caminho para corresponder ao seu diretório de miniaturas
$thumbdir = $dir . '/thumbs';

// alterar este caminho para corresponder ao seu diretório de fontes e a fonte desejada 
putenv('GDFONTPATH=' . 'C:/Windows/Fonts');
$font = 'arial';

// manipulando o envio da imagem
if ($_POST['submit'] == 'upload') {

// certifique-se a transferência do arquivo enviado foi bem-sucedida
    if ($_FILES['uploadfile']['error'] != UPLOAD_ERR_OK) {
        switch ($_FILES['uploadfile']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                die('O arquivo enviado exede o tamanho maximo permitido.' . 'in php.ini.');
                break;
            case UPLOAD_ERR_FORM_SIZE:
                die('O arquivo enviado exede o tamanho maximo permitido,' . 'Foi especificado no formulario HTML.');
                break;
            case UPLOAD_ERR_PARTIAL:
                die('O arquivo foi apenas parcialmente carregado!');
                break;
            case UPLOAD_ERR_NO_FILE:
                die('Arquivo não foi enviado!');
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                die('O servidor esta faltando uma pasta temporaria!');
                break;
            case UPLOAD_ERR_CANT_WRITE:
                die('O servidor não conseguiu gravar o arquivo carregado em disco.');
                break;
            case UPLOAD_ERR_EXTENSION:
                die('A extensão do arquivo carregado fora do padrão permitido!');
                break;
        }
    }
// obeter informacao sobre a imagem esta sendo carregada
    $image_caption = $_POST['caption'];
    $image_username = $_POST['username'];
    $image_date = date("Y-m-d");
    list($width, $height, $type, $attr) = getimagesize($_FILES['uploadfile']['tmp_name']);

// verifique se o arquivo enviado é realmente uma imagem suportada
    /*
     * 
      switch ($type) {
      case IMAGETYPE_GIF:
      $image = imagecreatefromgif($_FILES['uploadfile']['tmp_name']) or die('O arquivo enviado não era um tipo de arquivo suportado.');
      $ext = '.gif';
      break;
      case IMAGETYPE_JPEG:
      $image = imagecreatefromjpeg($_FILES['uploadfile']['tmp_name']) or die('O arquivo enviado não era um tipo de arquivo suportado.');
      $ext = '.jpg';
      break;
      case IMAGETYPE_PNG:
      $image = imagecreatefrompng($_FILES['uploadfile']['tmp_name']) or die('O arquivo enviado não era um tipo de arquivo suportado.');
      $ext = '.png';
      break;
      default :
      die('O arquivo enviado não era um tipo de arquivo suportado.');
      }
     * 
     */

    $error = 'O arquivo você corrego não e tipo de arquivo suportado!';
    switch ($type) {
        case IMAGETYPE_GIF:
            $image = imagecreatefromgif($_FILES['uploadfile']['tmp_name']) or die($error);
            break;
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($_FILES['uploadfile']['tmp_name']) or die($error);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($_FILES['uploadfile']['tmp_name']) or die($error);
            break;
        default :
            die($error);
    }

// inserir informacoes dentro tabela de imagem
    $query = 'INSERT INTO `images`'
            . '(`image_caption`, `image_username`, `image_date`) VALUES ("' . $image_caption . '", "' . $image_username . '", "' . $image_date . '")';
    @ $result = mysql_query($query, $db) or die(mysql_error($db));

// recuperar o ID de imagem que o MySQL gerada automaticamente quando inserimos
// o novo registro
    @ $last_id = mysql_insert_id();

// porque o id é único, podemos usá-lo como o nome da imagem, bem como para fazer
// certo de que não substituir uma outra imagem que já existe
    /*
     * $imagename = $last_id . $ext;

      // atualiza a imgem na tabela agora que o nome do arquivo final e conhecido
      $query = 'update `images`'
      . 'set image_filename ="' . $imagename . '"'
      . 'where image_id = ' . $last_id;
      @ $result = mysql_query($query, $db)or die(mysql_error($db));

      // salvar a imagem em seu destino final
      switch ($type) {
      case IMAGETYPE_GIF:
      imagegif($image, $dir . '/' . $imagename);
      break;
      case IMAGETYPE_JPEG:
      imagejpeg($image, $dir . '/' . $imagename, 100);
      break;
      case IMAGETYPE_PNG:
      imagepng($image, $dir . '/' . $imagename);
      break;
      }
     * 
     */
    // salva a imagem para seu destino final
    $image_id = $last_id;
    imagejpeg($image, $dir . '/' . $image_id . '.jpg');
    imagedestroy($image);
} else {
    // recuperar informacoes imagem
    $query = 'SELECT'
            . '`image_id`, `image_caption`, `image_username`, `image_date`'
            . 'FROM `images`'
            . 'WHERE image_id = 6'; //. $_POST['id']
    $result = mysql_query($query, $db) or die(mysql_error($db));
    extract(mysql_fetch_assoc($result));
    list($width, $height, $type, $attr) = getimagesize($dir . '/' . $image_id . '.jpg');
}
if ($_POST['submit'] == 'Save') {
    // certifique-se a imagem solicitada é válida
    if (isset($_POST['id']) && ctype_digit($_POST['id']) && file_exists($dir . '/' . $_POST['id'] . '.jpg')) {
        $image = imagecreatefromjpeg($dir . '/' . $_POST['id'] . '.jpg');
    } else {
        die('especifição de imagem invalida!');
    }

    // aplicando o filtro
    $effect = (isset($_POST['effect'])) ? $_POST['effect'] : -1;
    switch ($effect) {
        case IMG_FILTER_NEGATE:
            imagefilter($image, IMG_FILTER_NEGATE);
            break;
        case IMG_FILTER_GRAYSCALE:
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            break;
        case IMG_FILTER_EMBOSS:
            imagefilter($image, IMG_FILTER_EMBOSS);
            break;
        case IMG_FILTER_GAUSSIAN_BLUR:
            imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
            break;
    }
    // adicionar a legenda se requerido
    if(isset($_POST['emb_caption'])){
        imagettftext($image, 12, 0, 20, 20, 0, $font, $image_caption);
    }
    
    // adicionar o logo marca d'agua se requerido
    if(isset($_POST['emb_logo'])){
        // determina posicao x e y para centro marca d'agua
        list($wmk_width, $wmk_height) = getimagesize('imagens/logo.png');
        $x = ($width - $wmk_width) / 2;
        $y = ($height - $wmk_height) / 2;
        
        $wmk = imagecreatefrompng('imagens/logo.png');
        imagecopymerge($image, $wmk, $x, $y, 0, 0, $wmk_width, $wmk_height, 20);
        imagedestroy($wmk);
    }
    // salvando a imagem com filtro aplicado
    imagejpeg($image, $dir . '/' . $_POST['id'] . '.jpg', 100);
    
    // define o dimensao para a galeria de fotos
    $thumb_width = $width * 0.10;
    $thumb_height = $height * 0.10;
    
    // cria a galeria de fotos
    $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
    imagecopyresampled($thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
    imagejpeg($thumb, $dir . '/' . $_POST['id'] . '.jpg', 100);
    imagedestroy($thumb);
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>Aqui esta suas Fotos!</title>

            <?php
        } else {
            ?>
            <meta charset="UTF-8">
        </head>
        <body>
            <h1>Sua imagem foi salva!</h1>
            <h2>Então, como é a sensação de ser famoso?</h2>
            <p>Aqui está a foto que você acabou de enviar para os nossos servidores:</p>
            <img src="imagens/<?php echo $_POST['id']; ?>"/>
           <!-- <img src="imagens/<?php // echo $imagename; ?>" alt="Não foi possivel carregar sua imagem!" style="float: left;"> -->

            <?php
            if ($_POST['submit'] == 'upload') {
                $image_name = 'imagens' . $image_id . '.jpg';
            } else {
                $imagename = 'image_effect.php?id=' . $image_id . '$e=' . $_POST['effect'];
                if(isset($_POST['emb_caption'])){
                    $imagename .= '&capt=' . urlencode($image_caption);
                }
                if(isset($_POST['emb_logo'])){
                    $imagename .= '&logo=1';
                }
            }
            ?>
            <img src="<?php echo $imagename; ?>" style="float: left">
            <table>
                      <!-- <tr><td>Imagem salva como:</td><td><?php // echo $imagename;    ?></td></tr> -->
                      <!-- <tr><td>Tipo de imagem:</td><td><?php // echo $ext;    ?></td></tr> -->
                <tr><td>Imagem salva Como:</td><td><?php echo $image_id . '.jpg'; ?></td></tr>
                <tr><td>Altura:</td><td><?php echo $height; ?></td></tr>
                <tr><td>Comprimento:</td><td><?php echo $width; ?></td></tr>
                <tr><td>Atualiza data:</td><td><?php echo $image_date; ?></td></tr>
            </table>
            <p>Você pode aplicar um efeito especial para sua imagem na lista de opções a baixo. <br><strong>Notificação:</strong>guardar uma imagem com qualquer um dos filtros aplicados <em>não pode ser
                    desfeito</em>.</p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div>
                    <input type="hidden" name="id" value="<?php echo $image_id; ?>"/>
                    <select name="effect">
                        <option value="-1">None</option>
                        <?php
                        echo '<option value="' . IMG_FILTER_GRAYSCALE . '"';
                        if (isset($_POST['effect']) && $_POST['effect'] == IMG_FILTER_GRAYSCALE) {
                            echo 'selected="selected"';
                        }
                        echo '>Black and white</option>';
                        echo '<option value="' . IMG_FILTER_GAUSSIAN_BLUR . '"';
                        if (isset($_POST['effect']) && $_POST['effect'] == IMG_FILTER_GAUSSIAN_BLUR) {
                            echo 'selected="selected"';
                        }
                        echo '>Blur</option>';
                        echo '<option value="' . IMG_FILTER_EMBOSS . '"';
                        if (isset($_POST['effect']) && $_POST['effect'] == IMG_FILTER_EMBOSS) {
                            echo 'selected="selected"';
                        }
                        echo '>Emboss</option>';
                        echo '<option value="' . IMG_FILTER_NEGATE . '"';
                        if (isset($_POST['effect']) && $_POST['effect'] == IMG_FILTER_NEGATE) {
                            echo 'selected="selected"';
                        }
                        echo '>Negative</option>';
                        ?>
                    </select>
                    <br /><br />
                    <?php
                    echo '<input type="checkbox" name="emb_caption"';
                    if(isset($_POST['emb_caption'])){
                        echo 'checked="checked"';
                    }
                    echo '>Incorporando legenda na imagem?';
                    echo '<br /><br /><input type="checkbox" name="emb_logo"';
                    if(isset($_POST['emb_logo'])){
                        echo 'checked="checked"';
                    }
                    echo '>Incorporado logo marca d\'agua em imagem?';
                    ?>
                    <br/><br/>
                    <input type="submit" value="Preview" name="submit"/>
                    <input type="submit" value="Save" name="submit"/>
                </div>
            </form>
        </body>
    </html>
    <?php
}