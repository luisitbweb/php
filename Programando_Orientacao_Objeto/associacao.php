<?php
include_once './Fornecedor.class.php';
include_once './Produto.class.php';

// instancia fornecedor
$fornecedor = new Fornecedor();
$fornecedor->Codigo      = 848;
$fornecedor->RazaoSocial = 'Bom Gosto Alimentos S.A';
$fornecedor->Endereco    = 'Rua Ipiranga';
$fornecedor->Cidade      = 'Poços de Caldas' ;

// instancia produto
$produto = new Produto();
$produto->Codigo = 462;
$produto->Descricao = ' Doce de Pêssego';
$produto->Preco = 1.24;
$produto->Fornecedor = $fornecedor;

// imprime atributos
echo 'Codigo        : ' . $produto->Codigo                  . '<br>';
echo 'Descrição     : ' . $produto->Descricao               . '<br>';
echo 'Codigo        : ' . $produto->Fornecedor->Codigo      . '<br>';
echo 'Razão Social  : ' . $produto->Fornecedor->RazaoSocial . '<br>';