<?php
session_start();
require 'db.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Aqui é Seu Carrinho!</title>
        <style type="text/css">
            th{background-color: #999;}
            td{vertical-align: top;}
            .odd_row{background-color: #EEE;}
            .even_row{background-color: #FFF;}
        </style>
    </head>
    <body>
        <h1>Loja Livro Quadrinhos Apreciação</h1>
        <?php
        @ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
        @ mysql_select_db(MYSQL_DB, $db);

        $session = session_id();

        $query = 'SELECT'
                . '`p`.`product_code`, `qty`, `name`, `description`, `price` FROM'
                . '`ecomm_temp_cart` t JOIN `ecomm_products` p ON'
                . '(`t`.`product_code` = `p`.`product_code`) WHERE'
                . '`session` ="' . $session . '" ORDER BY'
                . '`t`.`product_code` ASC';
        $result = mysql_query($query, $db)or die(mysql_error($db));

        $rows = mysql_num_rows($result);
        if ($rows == 1) {
            echo '<p>Você está atualmente com 1 produto em seu carrinho.</p>';
        } else {
            echo '<p>Você está atualmente com "' . $rows . '" produtos em seu carrinho.</p>';
        }

        if ($rows > 0) {
            ?>

            <table style="width: 85%;">
                <tr>
                    <th style="width: 100px;">Produto</th> 
                    <th>Nome Itens</th>
                    <th>Quantidade</th>
                    <th>Preço Unitario</th>
                    <th>Preço Total</th>
                </tr>
                <tr>

                    <?php
                    $total = 0;
                    $odd = TRUE;
                    while ($row = mysql_fetch_array($result)) {
                        echo ($odd == TRUE) ? '<tr class="odd_row">' : '<tr class="even_row">';
                        $odd = !$odd;
                        extract($row);
                        ?>

                    <td style="text-align: center;"><a href="ecomm_view_product.php?product_code=<?php echo $product_code; ?>"><img width="60" height="60" src="imagens/<?php echo $product_code; ?>.jpg" alt="<?php echo $name; ?>"/></a></td>
                        <td><a href="ecomm_view_product.php?product_code=<?php echo $product_code; ?>"><?php echo $name; ?></a></td>
                        <td>
                            <form method="post" action="ecomm_update_cart.php">
                                <div>
                                    <input type="text" name="qty" maxlength="2" size="2" value="<?php echo $qty; ?>"/>
                                    <input type="hidden" name="product_code" value="<?php echo $product_code; ?>"/>
                                    <input type="hidden" name="redirect" value="ecomm_view_cart.php"/><br />
                                    <br /><input type="submit" name="submit" value="Change Qty"/>
                                </div>
                            </form>
                        </td>
                        <td style="text-align: right;">R$<?php echo $price; ?></td>
                        <td style="text-align: right">R$<?php echo number_format($price * $qty, 2); ?></td>
                    </tr>

                    <?php
                    $total = $total + $price * $qty;
                }
                ?>
            </table>

            <p>Valor total dos pedidos antes do envio é: <strong>R$<?php echo number_format($total, 2); ?></strong></p>

            <form method="post" action="ecomm_checkout.php">
                <div>
                    <input type="submit" name="submit" value="Proceed to Checkout" style="font-weight: bold;"/>
                </div>
            </form><br />

            <form method="post" action="ecomm_update_cart.php">
                <div>
                    <input type="hidden" name="redirect" value="ecomm_shop.php"/>
                    <input type="submit" name="submit" value="Empty Cart"/>
                </div>
            </form>

            <?php
        }
        ?>

        <hr />
        <p><a href="ecomm_shop.php">Voltar a pagina principal</a></p>
    </body>
</html>