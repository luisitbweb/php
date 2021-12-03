<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die('Conecção não estabelecida. Verifique seus parametros.');
@ mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

$action = 'Add';

$character = ['alias' => '', 'real_name' => '', 'alignment' => 'good', 'costume' => '', 'address' => '', 'city' => '', 'state' => '', 'zipcode_id' => ''];
$character_powers = array();
$rivalries = array();

// validar entrada caracter valor id
$character_id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

// recuperar informacoes sobre os requeridos caracter
if ($character_id != 0) {
    $query = 'SELECT `c`.`alias`, `c`.`real_name`, `c`.`alignment`, `c`.`costume`, `l`.`address`, `z`.`city`, `z`.`state`, `z`.`zipcode_id` FROM'
            . '`comic_character` c, `comic_lair` l, `comic_zipcode` z WHERE'
            . '`z`.`zipcode_id` = `l`.`zipcode_id` AND'
            . '`c`.`lair_id` = `l`.`lair_id` AND'
            . '`c`.`character_id` = ' . $character_id;
    $result = mysql_query($query, $db) or die(mysql_error($db));

    if (mysql_num_rows($result) > 0) {
        $action = 'Edit';
        $character = mysql_fetch_assoc($result);
    }
    mysql_free_result($result);

    if ($action == 'Edit') {
        // obter lista de caracteres força
        $query = 'SELECT `power_id` FROM'
                . '`comic_character_power` WHERE'
                . '`character_id` = ' . $character_id;
        $result = mysql_query($query, $db) or die(mysql_error($db));

        if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_array($result)) {
                $character_powers[$row['power_id']] = TRUE;
            }
        }
        mysql_free_result($result);

        // obter lista de caracteres rivais
        $query = 'SELECT `c2`.`character_id` FROM'
                . '`comic_character` c1 JOIN'
                . '`comic_character` c2 JOIN'
                . '`comic_rivalry` r ON'
                . '(`c1`.`character_id` = `r`.`hero_id` AND'
                . '`c2`.`character_id` = `r`.`villain_id`) OR'
                . '(`c2`.`character_id` = `r`.`hero_id` AND'
                . '`c1`.`character_id` = `r`.`villain_id`) WHERE'
                . '`c1`.`character_id` = "' . $character_id . '"ORDER BY'
                . '`c2`.`alias` ASC';
        $result = mysql_query($query, $db) or die(mysql_error($db));

        $rivalries = array();
        if (mysql_num_rows($result) > 0) {
            while ($row = mysql_fetch_array($result)) {
                $rivalries[$row['character_id']] = TRUE;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $action; ?>Caracteristicas</title>
        <style type="text/css">
            td{vertical-align: top;}
        </style>
    </head>
    <body>
        <img src="imagens/faviconkonami.jpg" alt="Site Avaliação livro quadrinhos" style="float: left;" />
        <h1>Livro Quadrinhos</h1>
        <h2><?php echo $action; ?> Caracteristicas</h2>
        <hr style="clear: both;" />
        <form action="char_transaction.php" method="post">
            <table>
                <tr>
                    <td>Character Name:</td>
                    <td><input type="text" name="alias" size="40" maxlength="40" value="<?php echo $character['alias']; ?>"></td>
                </tr>
                <tr>
                    <td>Real Name:</td>
                    <td><input type="text" name="real_name" size="40" maxlength="80" value="<?php echo $character['real_name']; ?>"></td>
                </tr>
                <tr>
                    <td>Powers:<br /><small><em>CTRL-Click para selecionar multiplos poderes</em></small></td>
                    <td>
                        <?php
                        // recuperar e apresentar a lista de poderes
                        $query = 'SELECT `power_id`, `power` FROM'
                                . '`comic_power` ORDER BY'
                                . '`power` ASC';
                        $result = mysql_query($query, $db) or die(mysql_error($db));

                        if (mysql_num_rows($result) > 0) {
                            echo '<select multiple name="powers[]">';
                            while ($row = mysql_fetch_array($result)) {
                                if (isset($character_powers[$row['power_id']])) {
                                    echo '<option value="' . $row['power_id'] . '" selected="selected">';
                                } else {
                                    echo '<option value="' . $row['power_id'] . '">';
                                }
                                echo $row['power'] . '</option>';
                            }
                            echo '</select>';
                        } else {
                            echo '<p><strong>Não entrou Powers...</strong></p>';
                        }
                        mysql_free_result($result);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">Lair Location:<br /><small><em>Address<br />City, State, Zip Code</em></small></td>
                    <td><input type="text" name="address" size="40" maxlength="40" value="<?php echo $character['address']; ?>"></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="city" size="23" maxlength="40" value="<?php echo $character['city']; ?>">
                        <input type="text" name="state" size="2" maxlength="2" value="<?php echo $character['state']; ?>">
                        <input type="text" name="zipcode_id" size="5" maxlength="5" value="<?php echo $character['zipcode_id']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Alignment:</td>
                    <td>
                        <input type="radio" name="alignment" value="good" <?php echo ($character['alignment'] == 'good') ? 'checked="checked"' : ''; ?> >Good<br />
                        <input type="radio" name="alignment" value="evil" <?php echo ($character['alignment'] == 'evil') ? 'checked="checked"' : ''; ?> >Evil
                    </td>
                </tr>
                <tr>
                    <td>Costume Description:</td>
                    <td><input type="text" name="costume" size="40" maxlength="255" value="<?php echo $character['costume']; ?>"></td>
                </tr>
                <tr>
                    <td>Rivalries:<br /><small><em>CTRL-click para selecionar multiplos rivais</em></small></td>
                    <td>
                        <?php
                        // recuperar e apresentar a lista de caracteres existentes excluindo os caracteres sendo editados
                        $query = 'SELECT `character_id`, `alias` FROM'
                                . '`comic_character` WHERE'
                                . '`character_id` != "' . $character_id . '"ORDER BY'
                                . '`alias` ASC';
                        $result = mysql_query($query, $db) or die(mysql_error($db));

                        if (mysql_num_rows($result) > 0) {
                            echo '<select multiple name="rivalries[]">';
                            while ($row = mysql_fetch_array($result)) {
                                if (isset($rivalries[$row['character_id']])) {
                                    echo '<option value="' . $row['character_id'] . '" selected="selected">';
                                } else {
                                    echo '<option value="' . $row['character_id'] . '">';
                                }
                                echo $row['alias'] . '</option>';
                            }
                            echo '</select>';
                        } else {
                            echo '<p><strong>Não entrou caracteres...</strong></p>';
                        }
                        mysql_free_result($result);
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="action" value="<?php echo $action; ?> Character" />
                        <input type="reset" value="Reset" />
                        <?php
                        if ($action == 'Edit') {
                            echo '<input type="submit" name="action" value="Delete Character" />';
                            echo '<input type="hidden" name="character_id" value="' . $character_id . '" />';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </form>
        <p><a href="list_characters.php">Retornar para Pagina Principal</a></p>
    </body>
</html>