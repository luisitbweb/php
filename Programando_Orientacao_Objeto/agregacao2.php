<?php
include_once './Cesta.class.php';
include_once './Fornecedor.class.php';
include_once './Produto.class.php';

$fornecedor = new Fornecedor();
$fornecedor->RazaoSocial = 'Produtos Bom Gosto S.A';

$cesta = new Cesta();
$cesta->AdicinaItem($fornecedor);

$cesta->CalculaTotal();
