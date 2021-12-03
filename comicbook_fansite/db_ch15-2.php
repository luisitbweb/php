<?php
require 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db(MYSQL_DB, $db);

$query = 'INSERT INTO `ecomm_products`'
        . '(`product_code`, `name`, `description`, `price`) VALUES'
        . '("00001", "CBA Logo T-shirt", "Esta T-shirt vai mostrar sua conexão com a CBA. Nossos t-shirt são toda feita de alta qualidade e 100% algodão pre encolhido.", "17.95"),'
        . '("00002", "CBA Bumper Sticker", "Deixe o mundo saber que você é um suporte orgulhoso do site da CBA com este autocolante no vidro colorido da etiqueta.", "5.95"),'
        . '("00003", "CBA Coffee Mug", "Com o logo tipo CBA olhando para trás em você sobre o seu copo da manhã de café, você tem certeza de ter um grande começo para o seu dia. nossas canecas são microondas e laváveis.", "8.95"),'
        . '("00004", "Superhero Body Suit", "Nós temos uma seleção completa de cores e tamanhos para você escolher a partir da. Este traje é elegante, na moda, e não vai atrapalhar tanto suas habilidades de combate ao crime ou habilidades conspiradores maus. Nós também oferecer a sua escolha em letra monogrammed applique.", "99.95"),'
        . '("00005", "Small Grappling Hook", "Este gancho especializada vai te tirar dos lugares mais apertados. Especialmente projetado para portabilidade e discrição, por favor esteja ciente que este gancho vem com um limite de peso.", "139.95"),'
        . '("00006", "Large Grappling Hook", "Para todas as necessidades de seu balanço pesados edifício-a-edifício, este grande versão do nosso gancho irá transportá-lo com segurança ao longo da cidade. Informamos, contudo, que a R$ 350 reais este não é o gancho para usar se você é um peso leve.", "199.95")';
mysql_query($query, $db)or die(mysql_error($db));

echo 'Sucesso!!!!!!!!!';