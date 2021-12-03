<?php
session_start();
require 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db(MYSQL_DB, $db);

$now = date('Y-m-d H:i:s');
$session = session_id();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address_1 = $_POST['address_1'];
$address_2 = $_POST['address_2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$shipping_first_name = $_POST['shipping_first_name'];
$shipping_last_name = $_POST['shipping_last_name'];
$shipping_address_1 = $_POST['shipping_address_1'];
$shipping_address_2 = $_POST['shipping_address_2'];
$shipping_city = $_POST['shipping_city'];
$shipping_state = $_POST['shipping_state'];
$shipping_zip_code = $_POST['shipping_zip_code'];
$shipping_phone = $_POST['shipping_phone'];
$shipping_email = $_POST['shipping_email'];
$tax_rate = $_POST['tax_rate'];
     
// atribuir ID de cliente para cliente novo, ou encontrar ID de cliente existente
$query = 'SELECT'
        . '`customer_id` FROM'
        . '`ecomm_customers` WHERE'
        . '`first_name` ="' . mysql_real_escape_string($first_name, $db) . '" AND'
        . '`last_name` ="' . mysql_real_escape_string($last_name, $db) . '" AND'
        . '`address_1` ="' . mysql_real_escape_string($address_1, $db) . '" AND'
        . '`address_2` ="' . mysql_real_escape_string($address_2, $db) . '" AND'
        . '`city` ="' . mysql_real_escape_string($city, $db) . '" AND'
        . '`state` ="' . mysql_real_escape_string($state, $db) . '" AND'
        . '`zip_code` ="' . mysql_real_escape_string($zip_code, $db) . '" AND'
        . '`phone` ="' . mysql_real_escape_string($phone, $db) . '" AND'
        . '`email` ="' . mysql_real_escape_string($email, $db) . '"';
$result = mysql_query($query, $db)or die(mysql_error($db));

if (mysql_num_rows($result) > 0){
    $row = mysql_fetch_assoc($result);
    extract($row);
}  else {
    $query = 'INSERT INTO `ecomm_customers`'
            . '(`customer_id`, `first_name`, `last_name`, `address_1`, `address_2`, `city`, `state`, `zip_code`, `phone`, `email`) VALUES'
            . '(NULL,'
            . '"' . mysql_real_escape_string($first_name, $db) . '",'
            . '"' . mysql_real_escape_string($last_name, $db) . '",'
            . '"' . mysql_real_escape_string($address_1, $db) . '",'
            . '"' . mysql_real_escape_string($address_2, $db) . '",'
            . '"' . mysql_real_escape_string($city, $db) . '",'
            . '"' . mysql_real_escape_string($state, $db) . '",'
            . '"' . mysql_real_escape_string($zip_code, $db) . '",'
            . '"' . mysql_real_escape_string($phone, $db) . '",'
            . '"' . mysql_real_escape_string($email, $db) . '")';
            mysql_query($query, $db)or die(mysql_error($db));
            $customer_id = mysql_insert_id();
}
mysql_free_result($result);

// iniciar inserindo ordem
$query = 'INSERT INTO `ecomm_orders`'
        . '(`order_id`, `order_date`, `customer_id`, `cost_subtotal`, `cost_total`, `shipping_first_name`, `shipping_last_name`, `shipping_address_1`, `shipping_address_2`, `shipping_city`, `shipping_state`, `shipping_zip_code`, `shipping_phone`, `shipping_email`) VALUES'
        . '(NULL,'
        . '"' . $now . '", "' . $customer_id . '", 0.00, 0.00,'
        . '"' . mysql_real_escape_string($shipping_first_name, $db) . '",'
        . '"' . mysql_real_escape_string($shipping_last_name, $db) . '",'
        . '"' . mysql_real_escape_string($shipping_address_1, $db) . '",'
        . '"' . mysql_real_escape_string($shipping_address_2, $db) . '",'
        . '"' . mysql_real_escape_string($shipping_city, $db) . '",'
        . '"' . mysql_real_escape_string($shipping_state, $db) . '",'
        . '"' . mysql_real_escape_string($shipping_zip_code, $db) . '",'
        . '"' . mysql_real_escape_string($shipping_phone, $db) . '",'
        . '"' . mysql_real_escape_string($shipping_email, $db) . '")';
mysql_query($query, $db)or die(mysql_error($db));
$order_id = mysql_insert_id();

// mover informacoes de ordem para ecomm_temp_cart dentro ecomm_order_details
$query = 'INSERT INTO `ecomm_order_details`'
        . '(`order_id`, `order_qty`, `product_code`) SELECT'
        . '"' . $order_id . '", `qty`, `product_code` FROM'
        . '`ecomm_temp_cart` WHERE'
        . '`session` ="' . $session . '"';
mysql_query($query, $db)or die(mysql_error($db));

$query = 'DELETE FROM `ecomm_temp_cart` WHERE `session` ="' . $session . '"';
mysql_query($query, $db)or die(mysql_error($db));

// recupera subtotal
$query = 'SELECT'
        . '`price`, `order_qty` FROM'
        . '`ecomm_order_details` d JOIN `ecomm_products` p ON'
        . '`d`.`product_code` = `p`.`product_code` WHERE'
        . '`order_id` =' . $order_id;
$result = mysql_query($query, $db)or die(mysql_error($db));

$row = mysql_fetch_assoc($result);
extract($row);

$array = mysql_fetch_array($result);
$price = $array['price'];
$order_qty = $array['order_qty'];
$cost_subtotal = $price * $order_qty;

// calcular o frete, impostos e custos totais
$cost_shipping = round($cost_subtotal * 0.25, 2);
$cost_tax = round($tax_rate * $cost_subtotal, 2);
$cost_total = $cost_subtotal + $cost_shipping + $cost_tax;

// atulizar custos na ecomm_orders
$query = 'UPDATE `ecomm_orders` SET'
        . '`cost_subtotal` ="' . $cost_subtotal . '",'
        . '`cost_shipping` ="' . $cost_shipping . '",'
        . '`cost_tax` ="' . $cost_tax . '",'
        . '`cost_total` ="' . $cost_total . '" WHERE'
        . '`order_id` =' . $order_id;
mysql_query($query, $db)or die(mysql_error($db));

ob_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Confirmação da Ordem</title>
        <style type="text/css">
            th{background-color: #999;}
            td{vertical-align: top;}
            .odd_row{background-color: #EEE;}
            .even_row{background-color: #FFF;}
        </style>
    </head>
    <body>
        
       <h1>Loja Livro Quadrinho Apreciação</h1>
        <h2>Verificar Ordem</h2>
        
        <ol>
            <li>Insira informações de faturamento e envio</li>
            <li>Verifique Precisão da Informação Ordem e Ordem Enviar</li>
            <li><strong>Confirmação de ordem e Recebimento</strong></li>
        </ol>
        
        <p>Aqui está um resumo do seu pedido:</p>
        <p>Data Ordem: <?php echo $now; ?></p>
        <p>Numero Ordem: <?php echo $order_id; ?></p>
        
        <table>
            <tr>
                <td>
                    <table>
                        <tr>
                            <th colspan="2">Informações de pagamento</th>
                        </tr>
                        <tr>
                            <td>Primeiro Nome:</td>
                            <td><?php echo htmlspecialchars($first_name); ?></td>
                        </tr>
                        <tr>
                            <td>Sobre Nome:</td>
                            <td><?php echo htmlspecialchars($last_name); ?></td>
                        </tr>
                        <tr>
                            <td>Enderoço 1:</td>
                            <td><?php echo htmlspecialchars($address_1); ?></td>
                        </tr>
                        <tr>
                            <td>Enderoço 2:</td>
                            <td><?php echo htmlspecialchars($address_2); ?></td>
                        </tr>
                        <tr>
                            <td>Cidade:</td>
                            <td><?php echo htmlspecialchars($city); ?></td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td><?php echo htmlspecialchars($state); ?></td>
                        </tr>
                        <tr>
                            <td>Codigo Postal:</td>
                            <td><?php echo htmlspecialchars($zip_code); ?></td>
                        </tr>
                        <tr>
                            <td>Numero Telefone:</td>
                            <td><?php echo htmlspecialchars($phone); ?></td>
                        </tr>
                        <tr>
                            <td>Endereço Email:</td>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <th colspan="2">Informações de envio</th>
                        </tr>
                        <tr>
                            <td>Primero Nome:</td>
                            <td><?php echo htmlspecialchars($shipping_first_name); ?></td>
                        </tr>
                        <tr>
                            <td>Sobre Nome:</td>
                            <td><?php echo htmlspecialchars($shipping_last_name); ?></td>
                        </tr>
                        <tr>
                            <td>Endereço 1:</td>
                            <td><?php echo htmlspecialchars($shipping_address_1); ?></td>
                        </tr>
                        <tr>
                            <td>Endereço 2:</td>
                            <td><?php echo htmlspecialchars($shipping_address_2); ?></td>
                        </tr>
                        <tr>
                            <td>Cidade:</td>
                            <td><?php echo htmlspecialchars($shipping_city); ?></td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td><?php echo htmlspecialchars($shipping_state); ?></td>
                        </tr>
                        <tr>
                            <td>Codigo Postal:</td>
                            <td><?php echo htmlspecialchars($shipping_zip_code); ?></td>
                        </tr>
                        <tr>
                            <td>Numero Telefone:</td>
                            <td><?php echo htmlspecialchars($shipping_phone); ?></td>
                        </tr>
                        <tr>
                            <td>Endereço Email:</td>
                            <td><?php echo htmlspecialchars($shipping_email); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <table style="width: 75%;">
            <tr>
                <th>Codigo Item</th>
                <th>Nome Item</th>
                <th>Quantidade</th>
                <th>Preço Unitario</th>
                <th>Preço Tatal</th>
            </tr>
            
            <?php
                $query = 'SELECT'
                        . '`p`.`product_code`, `order_qty`, `name`, `description`, `price` FROM'
                        . '`ecomm_order_details` d JOIN `ecomm_products` p ON'
                        . '`d`.`product_code` = `p`.`product_code` WHERE'
                        . '`order_id` ="' . $order_id . '" ORDER BY'
                        . '`p`.`product_code` ASC';
                $result = mysql_query($query, $db)or die(mysql_error($db));
                
                $rows = mysql_num_rows($result);
                
                $total = 0;
                $odd = TRUE;
                while ($row = mysql_fetch_array($result)){
                    echo ($odd == TRUE) ? '<tr class="odd_row">' : '<tr class="even_row">';
                    $odd = !$odd;
                    extract($row);
            ?>
            
            <td><?php echo $product_code; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $order_qty; ?></td>
            <td style="text-align: right;"><?php echo $price; ?></td>
            <td style="text-align: right;"><?php echo number_format($price * $order_qty, 2); ?></td>
        </tr>
            <?php
                }
            ?>
            
        </table>
        
        <p>Custo envio: R$<?php echo number_format($cost_subtotal, 2); ?></p>
        <p>Custo: R$<?php echo number_format($cost_tax, 2); ?></p>
        <p><strong>Total Custo: R$<?php echo number_format($cost_total, 2); ?></strong></p>
                        
        <h3>Uma cópia deste pedido foi enviado para você em seus registros.</h3>
    </body>
</html>

<?php

// enviando email
$headers = array();
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset="UTF-8"';
$headers[] = 'Content-Transfer-Encoding: 7bit';
$headers[] = 'From: <luisitb@ig.com.br>';
$headers[] = 'Bcc: <luisitb@ig.com.br>';

@ mail($email, "Confirmar Ordem", join("\r\n", $headers));