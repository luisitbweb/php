<?php
// funcao de carga automatica
function __autoload($classe){
    // busca classe no diretorio de classes...
    include_once "{$classe}.class.php";
}
// instanciando novo produto
$bolo = new Produto(500, 'Bolo de Fuba', 4, 4.12);
echo 'Codigo: ' . $bolo->Codigo    . '<br />';
echo 'Nome:   ' . $bolo->Descricao . '<br />';