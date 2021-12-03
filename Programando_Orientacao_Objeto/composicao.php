<?php
include_once './Fornecedor.class.php';
include_once './Contato.class.php';

// instancia novo fornecdor
$fornecedor = new Fornecedor();
$fornecedor->RazaoSocial = 'Produtos Bom Gosto S.A';

// atribui infromacoes de contato
$fornecedor->SetContato('Mauro', '14 2565-7896', 'mauro@bomgosto.com.br');

// imprime informacoes
echo $fornecedor->RazaoSocial . "<br />";
echo "Informações de Contato <br />";
echo $fornecedor->GetContato();