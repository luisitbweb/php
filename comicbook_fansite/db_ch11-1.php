<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or die('Conecção não estabelecida. Verifique seus parametros de conecção.');
@ mysql_select_db(MYSQL_DB, $db) or die(mysql_error($db));

// criar o cartao postal da tabela image
$query = 'CREATE TABLE IF NOT EXISTS pc_image('
        . 'image_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'image_url VARCHAR(255) NOT NULL DEFAULT "",'
        . 'description VARCHAR(255) NOT NULL DEFAULT "",'
        . 'PRIMARY KEY (image_id))'
        . 'ENGINE=InnoDB';
mysql_query($query, $db) or die(mysql_error($db));

// alterar essa pasta dependendo do seu servidor
$images_path = 'imagens';

// inserir novos dados dentro do cartao postal tabela imagem
$query = 'INSERT IGNORE INTO `pc_image`'
        . '(`image_id`, `image_url`, `description`) VALUES'
        . '(1, "' . $images_path . 'punyearth.jpg", "Wish you were here"),'
        . '(2, "' . $images_path . 'contrats.jpg", "Congratulations"),'
        . '(3, "' . $images_path . 'Visit.jpg", "We\'re coming to visit"),'
        . '(4, "' . $images_path . 'sympathy.jpg", "Our Sympathies")';
mysql_query($query, $db) or die(mysql_error($db));

echo 'Sucesso!!!';