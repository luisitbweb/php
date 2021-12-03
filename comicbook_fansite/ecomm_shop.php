<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Site Livro Quadrinhos Apreciação Lista Produto </title>
        <style type="text/css">
            th{background-color: #999;}
            td{vertical-align: top;}
            .odd_row{background-color: #EEE;}
            .even_row{background-color: #FFF;}
            a{text-decoration: none;}
        </style>
    </head>
    <body>
        <h1>Loja Livro Quadrinhos Apreciação</h1>
        <p><a href="ecomm_view_cart.php">Ver Carrinho</a></p>
        <p>Obrigado por visitar nosso site! Por favor, veja nossa lista de produtos disponíveis
            abaixo, e clique no link para mais informações:</p>

        <table style="width: 75%;">
            <?php
            require 'db.inc.php';

            @ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
            @ mysql_select_db(MYSQL_DB, $db);

            $query = 'SELECT'
                    . '`product_code`, `name`, `price` FROM'
                    . '`ecomm_products` ORDER BY'
                    . '`product_code` ASC';
            $result = mysql_query($query, $db)or die(mysql_error($db));

            $odd = TRUE;
            while ($row = mysql_fetch_array($result)) {
                echo ($odd == TRUE) ? '<tr class="odd_row">' : '<tr class="even_row">';
                $odd = !$odd;
                extract($row);
                echo '<td style="text-align: center; width: 100px;"><a href="ecomm_view_product.php?product_code=' . $product_code . '"><img width="60" height="60" src="imagens/' . $product_code . '.jpg" alt="' . $name . '"/></a></td>';
                echo '<td><a href="ecomm_view_product.php?product_code=' . $product_code . '">' . $name . '</a></td>';
                echo '<td style="text-align: right;"><a href="ecomm_view_product.php?product_code=' . $product_code . '">' . $price . '</a></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </body>
</html>