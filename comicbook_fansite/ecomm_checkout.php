<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Verificar Passo 1 de 3</title>

        <style type="text/css">
            th{background-color: #999;}
            td{vertical-align: top;}
            .odd_row{background-color: #EEE;}
            .even_row{background-color: #FFF;}
        </style>

        <script type="text/javascript">

            window.onload = function () {
                // atribuir toggle_shipping_visibility para same_info checkbox
                var c = document.getElementById('same_info');
                c.onchange = toggle_shipping_visibility;
            }

            function toggle_shipping_visibility() {
                var c = document.getElementById('same_info');
                var t = document.getElementById('shipping_table');

                // atualizar tabela shipping visibility
                t.style.display = (c.checked) ? 'none' : '';
            }

        </script>
    </head>
    <body>
        <h1>Loja Livro Quadrinho Apreciação</h1>
        <h2>Ordem Verificação</h2>

        <ol>
            <li><strong>Insira informações de faturamento e envio</strong></li>
            <li>Verifique Precisão da Informação Ordem e Ordem Enviar</li>
            <li>Confirmação de ordem e Recebimento</li>
        </ol>

        <form method="post" action="ecomm_checkout2.php">
            <table>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <th colspan="2">Informações Faturamento:</th>
                            </tr>
                            <tr>
                                <td><label for="first_name">Primeiro Nome:</label></td>
                                <td><input type="text" id="first_name" name="first_name" size="20" maxlength="20"/></td>
                            </tr>
                            <tr>
                                <td><label for="last_name">Sobre Nome:</label></td>
                                <td><input type="text" id="last_name" name="last_name" size="20" maxlength="20"/></td>
                            </tr>
                            <tr>
                                <td><label for="address_1">Faturar Endereço:</label></td>
                                <td><input type="text" id="address_1" name="address_1" size="30" maxlength="50"/></td>
                            </tr>
                            <tr>
                                <td><label for="address_2">Endereço Opcional:</label></td>
                                <td><input type="text" id="address_2" name="address_2" size="30" maxlength="50"/></td>
                            </tr>
                            <tr>
                                <td><label for="city">Cidade:</label></td>
                                <td><input type="text" id="city" name="city" size="20" maxlength="20"/></td>
                            </tr>
                            <tr>
                                <td><label for="state">Estado:</label></td>
                                <td><input type="text" id="state" name="state" size="20" maxlength="20"/></td>
                            </tr>
                            <tr>
                                <td><label for="zip_code">Codigo Postal:</label></td>
                                <td><input type="text" id="zip_code" name="zip_code" size="9" maxlength="9"/></td>
                            </tr>
                            <tr>
                                <td><label for="phone">Numero Telefone:</label></td>
                                <td><input type="tel" id="phone" name="phone" size="10" maxlength="10"/></td>
                            </tr>
                            <tr>
                                <td><label for="email">Endereço Email:</label></td>
                                <td><input type="email" id="email" name="email" size="30" maxlength="100"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <input type="checkbox" id="sam_info" name="same_info" checked="checked"/>
                                    <label for="same_info">Informações de envio é o mesmo que faturamento</label>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table id="shiping_table" style="display: none;">
                            <tr>
                                <th colspan="2">Informação de Envio</th>
                            </tr>
                            <tr>
                                <td><label for="shipping_first_name">Primeiro Nome:</label></td>
                                <td><input type="text" id="shipping_first_name" name="shipping_first_name" size="20" maxlength="20"/></td>
                            </tr>
                            <tr>
                                <td><label for="shipping_last_name">Sobre Nome:</label></td>
                                <td><input type="text" id="shipping_last_name" name="shipping_last_name" size="20" maxlength="20"/></td>
                            </tr>
                            <tr>
                                <td><label for="shipping_address_1">Endereço para envio:</label></td>
                                <td><input type="text" id="shipping_address_1" name="shipping_address_1" size="30" maxlength="50"/></td>
                            </tr>
                            <tr>
                                <td><label for="shipping_address_2">Endereço para envio opcional:</label></td>
                                <td><input type="text" id="shipping_address_2" name="shipping_address-2" size="30" maxlength="50"/></td>
                            </tr>
                            <tr>
                                <td><label for="shipping_city">Cidade:</label></td>
                                <td><input type="text" id="shipping_city" name="shipping_city" size="20" maxlength="20"/></td>
                            </tr>
                            <tr>
                                <td><label for="shipping_state">Estado:</label></td>
                                <td><input type="text" id="shipping_state" name="shipping_state" size="2" maxlength="2"/></td>
                            </tr>
                            <tr>
                                <td><label for="shipping_zip_code">Codigo Postal:</label></td>
                                <td><input type="text" id="shipping_zip_code" name="shipping_zip_code" size="9" maxlength="9"/></td>
                            </tr>
                            <tr>
                                <td><label for="shipping_phone">Numero Telefone:</label></td>
                                <td><input type="tel" id="shipping_phone" name="shipping_phone" size="10" maxlength="10"/></td>
                            </tr>
                            <tr>
                                <td><label for="shippging_email">Endereço Email:</label></td>
                                <td><input type="text" id="shipping_email" name="shipping_email" size="30" maxlength="100"/></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Proceed to Next Step"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>