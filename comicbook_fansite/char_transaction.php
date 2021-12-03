<?php

require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die('Conecção não estabelecida. verifivar seus parametros conecção.');
@ mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

switch ($_POST['action']) {
    case 'Add Character':
        // escapar valores de entrada para proteger o banco de dados
        $alias = mysql_real_escape_string($_POST['alias'], $db);
        $real_name = mysql_real_escape_string($_POST['real_name'], $db);
        $address = mysql_real_escape_string($_POST['address'], $db);
        $city = mysql_real_escape_string($_POST['city'], $db);
        $state = mysql_real_escape_string($_POST['state'], $db);
        $zipcode_id = mysql_real_escape_string($_POST['zipcode_id'], $db);
        $alignment = ($_POST['alignment'] == 'good') ? 'good' : 'evil';
        $costume = mysql_real_escape_string($_POST['costume'], $db);

        // adicinar caracteres informacao na tabela dentro banco de dados 
        $query = 'INSERT IGNORE INTO `comic_zipcode`'
                . '(`zipcode_id`, `city`, `state`) VALUES'
                . '("' . $zipcode_id . '", "' . $city . '", "' . $state . '")';
        mysql_query($query, $db) or die(mysql_error($db));

        $query = 'INSERT INTO `comic_lair`'
                . '(`lair_id`, `zipcode_id`, `address`) VALUES'
                . '(NULL, "' . $zipcode_id . '", "' . $address . '")';
        mysql_query($query, $db) or die(mysql_error($db));

        // recuperar nova lair_id gerada pelo mysql
        $lair_id = mysql_insert_id($db);
        $query = 'INSERT INTO `comic_character`'
                . '(`character_id`, `alias`, `real_name`, `lair_id`, `alignment`, `costume`) VALUES'
                . '(NULL, "' . $alias . '", "' . $real_name . '", "' . $lair_id . '", "' . $alignment . '", "' . $costume . '")';
        mysql_query($query, $db) or die(mysql_error($db));

        // recuperar novo character_id gerado pelo mysql
        $character_id = mysql_insert_id($db);
        if (!empty($_POST['powers'])) {
            $values = array();
            foreach ($_POST['powers'] as $power_id) {
                $values[] = sprintf('(%d, %d)', $character_id, $power_id);
            }
            $query = 'INSERT INTO `comic_character_power`'
                    . '(`character_id`, `Power_id`) VALUES'
                    . implode(',', $values);
            mysql_query($query, $db) or die(mysql_error($db));
        }
        if (!empty($_POST['rivalries'])) {
            $values = array();
            foreach ($_POST['rivalries'] as $rival_id) {
                $values[] = sprintf('(%d, %d)', $character_id, $rival_id);
            }
            // alinhamento vai afetar a coluna de order
            $columns = ($alignment = 'good') ? '(hero_id, villain_id)' : '(villain_id, hero_id)';
            $query = 'INSERT IGNORE INTO `comic_rivalry`'
                    . $columns . 'VALUES'
                    . '("' . implode(',', $values) . '")';
            mysql_query($query, $db) or die(mysql_error($db));
        }
        $redirect = 'list_characters.php';
        break;

    case 'Delete Character':
        // certificar-se character_id e um numero apenas para ser seguro
        $character_id = (int) $_POST['character_id'];

        // deletando caracteres informacao da tabela
        $query = 'DELETE FROM c, 1 USING'
                . '`comic_character` c, `comic_lair` 1 WHERE'
                . '`c`.`lari_id` = `1`.`lair_id` AND'
                . '`c`.`character_id` = ' . $character_id;
        mysql_query($query, $db) or die(mysql_error($db));

        $query = 'DELETE FROM `comic_character_power` WHERE'
                . '`character_id` = ' . $character_id;
        mysql_query($query, $db) or die(mysql_error($db));

        $query = 'DELETE FROM `comic_rivalry` WHERE'
                . '`hero_id` = ' . $character_id . 'OR villain_id = ' . $character_id;
        mysql_query($query, $db) or die(mysql_error($db));

        $redirect = 'list_characters.php';
        break;

    case 'Edit Character':
        // escapar valores de entrada para protejer banco de dados
        $character_id = (int) $_POST['character_id'];
        $alias = mysql_escape_string($_POST['alias'], $db);
        $real_name = mysql_escape_string($_POST['real_name'], $db);
        $address = mysql_escape_string($_POST['address'], $db);
        $city = mysql_escape_string($_POST['city'], $db);
        $state = mysql_escape_string($_POST['state'], $db);
        $zipcode_id = mysql_escape_string($_POST['zipcode_id'], $db);
        $alignment = ($_POST['alignment'] == 'good') ? 'good' : 'evil';
        $costume = mysql_real_escape_string($_POST['costume'], $db);

        // atualizar informacoes da tabela caracteres existentes
        $query = 'INSERT IGNORE INTO `comic_zipcode`'
                . '(`zipcode_id`, `city`, `state`) VALUES'
                . '("' . $zipcode_id . '", "' . $city . '", "' . $state . '")';
        mysql_query($query, $db) or die(mysql_error($db));

        $query = 'UPDATE `comic_lair` 1, `comic_character` c SET'
                . '`1`.`zipcode_id` = "' . $zipcode_id . '",'
                . '`1`.`address` = "' . $address . '",'
                . '`c`.`real_name` = "' . $real_name . '",'
                . '`c`.`alias` = "' . $alias . '",'
                . '`c`.`alignment` = "' . $alignment . '",' 
                . '`c`.`costume` = "' . $costume . '" WHERE'
                . '`c`.`character_id` = "' . $character_id . '" AND `c`.`lair_id` = `1`.`lair_id`';
        mysql_query($query, $db) or die(mysql_error($db));

        $query = 'DELETE FROM `comic_character_power` WHERE'
                . '`character_id` = ' . $character_id;
        mysql_query($query, $db) or die(mysql_error($db));

        if (!empty($_POST['powers'])) {
            $values = array();
            foreach ($_POST['powers'] as $power_id) {
                $values[] = sprintf('(%d, %d)', $character_id, $power_id);
            }

            $query = 'INSERT IGNORE INTO `comic_character_power`'
                    . '(`character_id`, `power_id`) VALUES'
                    . '("' . implode(',', $values) . '")';
            mysql_query($query, $db) or die(mysql_error($db));
        }

        $query = 'DELETE FROM `comic_rivalry` WHERE'
                . '`hero_id` = "' . $character_id . '"OR `villain_id` = ' . $character_id;
        mysql_query($query, $db) or die(mysql_error($db));

        if (!empty($_POST['rivalries'])) {
            $values = array();
            foreach ($_POST['rivlaries'] as $rival_id) {
                $values[] = sprintf('(%d, %d)', $character_id, $rival_id);
            }
            // alinhamento vai afetar coluna de order
            $columns = ($alignment = 'good') ? '(hero_id, villain_id)' : '(villain_id, hero_id)';
            $query = 'INSERT IGNORE INTO `comic_rivalry` "' . $columns . '" VALUES'
                    . '("' . implode(',', $values) . '")';
            mysql_query($query, $db) or die(mysql_error($db));

            $redirect = 'list_characters.php';
            break;
        }

    case 'Delete Selected Powers':
        if (!empty($_POST['powers'])) {
            // escapar valores de entrada para projeto banco de dados eles devem ter valores numericos mas apenas para ser seguro
            $powers = implode(',', $_POST['powers']);
            $powers = mysql_real_escape_string($powers, $db);

            // deletar poderes
            $query = 'DELETE FROM `comic_power` WHERE'
                    . '`power_id` IN ("' . $powers . '")';
            mysql_query($query, $db) or die(mysql_error($db));

            $query = 'DELETE FROM `comic_character_power` WHERE'
                    . '`power_id` IN ("' . $powers . '")';
            mysql_query($query, $db) or die(mysql_error($db));
        }
        $redirect = 'edit_power.php';
        break;

    case 'Add New Power':
        // para e verificar poder para prevenir a adicionamento valores com espaco em branco
        $power = trim($_POST['new_power']);
        if ($power != '') {
            // escapar entrada valores
            $power = mysql_escape_string($power, $db);

            // criar novo poder
            $query = 'INSERT IGNORE INTO `comic_power`'
                    . '(`power_id`, `power`) VALUES'
                    . '(NULL, "' . $power . '")';
            mysql_query($query, $db) or die(mysql_error($db));
        }
        $redirect = 'edit_power.php';
        break;

    default :
        $redirect = 'list_characters.php';
}
header('Location: ' . $redirect);