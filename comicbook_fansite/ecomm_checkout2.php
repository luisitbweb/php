<?php
session_start();
require 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db(MYSQL_DB, $db);

$session = session_id();

if (isset($_POST['same_info'])) {
    $_POST['shipping_first_name'] = $_POST['first_name'];
    $_POST['shipping_last_name'] = $_POST['last_name'];
    $_POST['shipping_address_1'] = $_POST['address_1'];
    $_POST['shipping_address_2'] = $_POST['address_2'];
    $_POST['shipping_city'] = $_POST['city'];
    $_POST['shipping_state'] = $_POST['state'];
    $_POST['shipping_zip_code'] = $_POST['zip_code'];
    $_POST['shipping_phone'] = $_POST['phone'];
    $_POST['shipping_email'] = $_POST['email'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Verificar Passo 2 de 3</title>
        <style type="text/css">
            th{background-color: #999;}
            td{vertical-align: top;}
            .odd_row{background-color: #EEE;}
            .even_row{background-color: #FFF;}
        </style>
    </head>
    <body>
        <h1>Loja Livro Quadrinho Apreciação</h1>
        <h2>Verificação ordem</h2>
        <ol>
            <li>Insira informações de faturamento e envio</li>
            <li><strong>Verifique Precisão da Informação Ordem e Ordem Enviar</strong></li>
            <li>Confirmação de ordem e Recebimento</li>
        </ol>
        <table style="width: 75%;">
            <tr>
                <th style="width: 100px;">Produto</th>
                <th>Nome Item</th>
                <th>Quantidade</th>
                <th>Preço Unitario</th>
                <th>Preço Total</th>
            </tr>
            <?php
            $query = 'SELECT'
                    . '`t`.`product_code`, `qty`, `name`, `description`, `price` FROM'
                    . '`ecomm_temp_cart` t JOIN `ecomm_products` p ON'
                    . '`t`.`product_code` = `p`.`product_code` WHERE'
                    . '`session` ="' . $session . '" ORDER BY'
                    . '`t`.`product_code` ASC';
            $result = mysql_query($query, $db)or die(mysql_error($db));

            $rows = mysql_num_rows($result);

            $subtotal = 0;
            $odd = TRUE;

            while ($row = mysql_fetch_array($result)) {
                echo ($odd == TRUE) ? '<tr class="odd_row">' : '<tr class="even_row">';
                $odd = !$odd;
                extract($row);
                ?>

            <td style="text-align: center;"><img src="imagens/<?php echo $product_code; ?>.jpg" alt="<?php echo $name; ?>" width="60" height="60"/></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $qty; ?></td>
                <td style="text-align: right;">R$<?php echo $price; ?></td>
                <td style="text-align: right">R$<?php echo number_format($price * $qty, 2); ?></td>

                <?php
                $subtotal = $subtotal + $price * $qty;
            }
            ?>

        </table>

        <p>Seu subtotal antes do frete e impostos é: <strong>R$<?php echo number_format($subtotal, 2); ?></strong></p>
        <p>Seu total é: <strong>$<?php
        $tax_state = 'CA';
        
        if(($_POST['state']) == $tax_state){
            $tax_rate = 0.07;
        }  else {
            $tax_rate = 0.00;
        }
        
        $tax = $subtotal * $tax_rate;
        $total = $subtotal + $tax;
        
        echo number_format($total, 2); ?></strong></p>

        <table>
            <tr>
                <td>
                    <table>
                        <tr>
                            <th colspan="2">Informações de pagamento</th>
                        </tr>
                        <tr>
                            <td>Primeiro Nome:</td>
                            <td><?php echo htmlspecialchars($_POST['first_name']); ?></td>
                        </tr>
                        <tr>
                            <td>Sobre Nome:</td>
                            <td><?php echo htmlspecialchars($_POST['last_name']); ?></td>
                        </tr>
                        <tr>
                            <td>Primeiro endereço de Cobrança:</td>
                            <td><?php echo htmlspecialchars($_POST['address_1']); ?></td>
                        </tr>
                        <tr>
                            <td>Segundo endereço de Cobrança:</td>
                            <td><?php echo htmlspecialchars($_POST['address_2']); ?></td>
                        </tr>
                        <tr>
                            <td>Cidade:</td>
                            <td><?php echo htmlspecialchars($_POST['city']); ?></td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td><?php echo htmlspecialchars($_POST['state']); ?></td>
                        </tr>
                        <tr>
                            <td>Codigo Postal:</td>
                            <td><?php echo htmlspecialchars($_POST['zip_code']); ?></td>
                        </tr>
                        <tr>
                            <td>Numero Telefone:</td>
                            <td><?php echo htmlspecialchars($_POST['phone']); ?></td>
                        </tr>
                        <tr>
                            <td>Endereço Email:</td>
                            <td><?php echo htmlspecialchars($_POST['email']); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center;">

                                <?php
                                if (isset($_POST['same_info'])) {
                                    echo 'Informações de envio é o mesmo que o faturamento.';
                                }
                                ?>

                            </td>
                        </tr>
                    </table>
                </td>
                <td>

                    <?php
                    if (!isset($_POST['same_info'])) {
                        ?>

                        <table>
                            <tr>
                                <th colspan="2">Informação de envio</th>
                            </tr>
                            <tr>
                                <td>Primeiro Nome:</td>
                                <td><?php echo htmlspecialchars($_POST['shipping_first_name']); ?></td>
                            </tr>
                            <tr>
                                <td>Sobre Nome:</td>
                                <td><?php echo htmlspecialchars($_POST['shipping_last_name']); ?></td>
                            </tr>
                            <tr>
                                <td>Endereço 1 de Cobrança:</td>
                                <td><?php echo htmlspecialchars($_POST['shipping_address_1']); ?></td>
                            </tr>
                            <tr>
                                <td>Endereço 2 de Cobrança:</td>
                                <td><?php echo htmlspecialchars($_POST['shipping_address_2']); ?></td>
                            </tr>
                            <tr>
                                <td>Cidade:</td>
                                <td><?php echo htmlspecialchars($_POST['shipping_city']); ?></td>
                            </tr>
                            <tr>
                                <td>Estado:</td>
                                <td><?php echo htmlspecialchars($_POST['shipping_state']); ?></td>
                            </tr>
                            <tr>
                                <td>Codigo Postal:</td>
                                <td><?php echo htmlspecialchars($_POST['shipping_zip_code']); ?></td>
                            </tr>
                            <tr>
                                <td>Numero Telefone:</td>
                                <td><?php echo htmlspecialchars($_POST['shipping_phone']); ?></td>
                            </tr>
                            <tr>
                                <td>Endereço Email:</td>
                                <td><?php echo htmlspecialchars($_POST['shipping_email']); ?></td>
                            </tr>
                        </table>

                        <?php
                    }
                    ?>
                    
                </td>
            </tr>
        </table>
        <form method="post" action="ecomm_checkout3.php">
            <div>
                <input type="submit" name="submit" value="Process Order"/>
                <input type="hidden" name="first_name" value="<?php echo htmlspecialchars($_POST['first_name']); ?>"/>
                <input type="hidden" name="last_name" value="<?php echo htmlspecialchars($_POST['last_name']); ?>"/>
                <input type="hidden" name="address_1" value="<?php echo htmlspecialchars($_POST['address_1']); ?>"/>
                <input type="hidden" name="address_2" value="<?php echo htmlspecialchars($_POST['address_2']); ?>"/>
                <input type="hidden" name="city" value="<?php echo htmlspecialchars($_POST['city']); ?>"/>
                <input type="hidden" name="state" value="<?php echo htmlspecialchars($_POST['state']); ?>"/>
                <input type="hidden" name="zip_code" value="<?php echo htmlspecialchars($_POST['zip_code']); ?>"/>
                <input type="hidden" name="phone" value="<?php echo htmlspecialchars($_POST['phone']); ?>"/>
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>"/>
                <input type="hidden" name="shipping_first_name" value="<?php echo htmlspecialchars($_POST['shipping_first_name']); ?>"/>
                <input type="hidden" name="shipping_last_name" value="<?php echo htmlspecialchars($_POST['shipping_last_name']); ?>"/>
                <input type="hidden" name="shipping_address_1" value="<?php echo htmlspecialchars($_POST['shipping_address_1']); ?>"/>
                <input type="hidden" name="shipping_address_2" value="<?php echo htmlspecialchars($_POST['shipping_address_2']); ?>"/>
                <input type="hidden" name="shipping_city" value="<?php echo htmlspecialchars($_POST['shipping_city']); ?>"/>
                <input type="hidden" name="shipping_state" value="<?php echo htmlspecialchars($_POST['shipping_state']); ?>"/>
                <input type="hidden" name="shipping_zip_code" value="<?php echo htmlspecialchars($_POST['shipping_zip_code']); ?>"/>
                <input type="hidden" name="shipping_phone" value="<?php echo htmlspecialchars($_POST['shipping_phone']); ?>"/>
                <input type="hidden" name="shipping_email" value="<?php echo htmlspecialchars($_POST['shipping_email']); ?>"/>
                <input type="hidden" name="tax_rate" value="<?php echo $tax_rate; ?>"/>
            </div>
        </form>
    </body>
</html>