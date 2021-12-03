<?php
// inclui classe produto
include_once './Produto.class.php';

// criando novo produto com o preco R$ 345.67
$produto = new Produto(1, 'Pendrive 8GB', 1, 345.67);

// executando metodo vender, passando 10 unidades.
echo $produto->Vender(10);