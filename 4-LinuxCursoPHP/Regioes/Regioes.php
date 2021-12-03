<?php

namespace Regioes;
// Require para os arquivos de São Paulo
require_once('Estados/SaoPaulo.php');
require_once('Estados/Cidades/SaoPaulo.php');

// Require para os arquivos do Rio de Janeiro
require_once('Estados/RioDeJaneiro.php');
require_once('Estados/Cidades/RioDeJaneiro.php');

// Uso de Apelidos para resolver o conflito de NameSpaces
use Regioes\Estados\SaoPaulo as EstadosDeSaoPaulo;
use Regioes\Cidades\SaoPaulo as CidadesDeSaoPaulo;
// Instanciando os Objetos
$estado1 = new EstadosDeSaoPaulo();
$cidade1 = new CidadesDeSaoPaulo();
// Imprimindo os Returns
echo 'A <strong>' . $cidade1->cidade() . '</strong> está situada no <strong>' . $estado1->estado() . '</strong>.<hr />';

// Uso de Apelidos para resolver o conflito de NameSpaces
use Regioes\Estados\RioDeJaneiro as EstadosDoRioDeJaneiro;
use Regioes\Cidades\RioDeJaneiro as CidadesDoRioDeJaneiro;
// Instanciando os Objetos
$estado2 = new EstadosDoRioDeJaneiro();
$cidade2 = new CidadesDoRioDeJaneiro();
// Imprimindo os Returns
echo 'A <strong>' . $cidade2->cidade() . '</strong> está situada no <strong>' . $estado2->estado() . '</strong>.<hr />';