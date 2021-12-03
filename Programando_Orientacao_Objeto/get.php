<?php
// inclui classe produto
include_once './Produto.class.php';

// cria novo produto com preco R$ 345.67
$produto = new Produto(1, 'Pendrive 8GB', 1, 345.67);

// imprime o preco
echo $produto->Preco;