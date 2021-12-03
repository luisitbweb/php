<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida. verifique seus parametros de conecção!');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviando Cartão Postal</title>

        <script src='postcard.js' type="text/javascript"></script>
    </head>
    <body>
        <h1>Enviando Cartão Postal</h1>
        <form method="post" action="sendconfirm.php">
            <table>
                <tr>
                    <td>Nome Remetente:</td>
                    <td><input type="text" name="from_name" size="40" /></td>
                </tr>
                <tr>
                    <td>Remetente E-mail:</td>
                    <td><input type="text" name="from_email" size="40" /></td>
                </tr>
                <tr>
                    <td>Nome Destinatario:</td>
                    <td><input type="text" name="to_name" size="40" /></td>
                </tr>
                <tr>
                    <td>E-mail Destinatario:</td>
                    <td><input type="text" name="to_email" size="40" /></td>
                </tr>
                <tr>
                    <td>Escolher um Cartão Postal:</td>
                    <td><select id="postcard_select" name="postcard">

                            <?php
                            $query = 'SELECT `image_url`, `description`FROM'
                                    . '`pc_image` ORDER BY'
                                    . '`description`';
                            $result = mysql_query($query, $db)or die(mysql_error($db));

                            $row = mysql_fetch_assoc($result);
                            extract($row);

                            mysql_data_seek($result, 0);
                            while ($row = mysql_fetch_assoc($result)) {
                                echo '<option value="' . $row['image_url'] . '">' . $row['description'] . '</option>';
                            }
                            mysql_free_result($result);
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <img id="postcard" src="imagens/<?php echo $image_url; ?>" alt="<?php echo $description; ?>" />
                    </td>
                </tr>
                <tr>
                    <td>Assunto:</td>
                    <td><input type="text" name="subject" size="49" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea cols="76" rows="12" name="message" placeholder="Entre com sua mensagem aqui." style="resize: vertical;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Send" />
                        <input type="reset" value="Resetar o formulario" />
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>