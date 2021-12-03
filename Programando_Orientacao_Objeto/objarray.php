<?php
// cria array dados_william
$dados_william['nome']      = 'William Scatola';
$dados_william['idade']     = 22;
$dados_william['profissao'] = 'Controle de Estoque';

// cria array dados_daline
$dados_daline['nome']      = 'Daline Dalloglio';
$dados_daline['idade']     = 21;
$dados_daline['profissao'] = 'Almoxarifado';

// cria objeto william
foreach ($dados_william as $chave => $valor){
    // utiliza variaveis variantes
     $william->$chave = $valor;
}

// cria objeto daline
foreach ($dados_daline as $chave => $valor){
    // utiliza variaveis variantes
     $daline->$chave = $valor;
}

echo "Nome: {$william->nome} e Profissao: {$william->profissao}<br />";
echo "Nome: {$daline->nome}  e Profissao: {$daline->profissao} <br />";