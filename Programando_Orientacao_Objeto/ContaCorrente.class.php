<?php

require_once 'Conta.class.php';

class ContaCorrente extends Conta {

    var $Limite;
    var $TaxaTransferencia = 2.5;

    /*
     * metodo construtor sobrescrito
     * agora tambem inicializando a variavel $limite
     */

    function __construct($Agencia, $Codigo, $DataDeCriacao, $Titular, $Senha, $Saldo, $Limite) {

        // chamada do metodo construtor da classe-pai.
        parent::__construct($Agencia, $Codigo, $DataDeCriacao, $Titular, $Senha, $Saldo);
        $this->Limite = $Limite;
    }

    /*
     * metodo retirar sobescrito
     * verifica se a $quantia retirada esta dentro do limite.
     */

    function Retirar($quantia) {

        // imposto sobre mivimentacao financeira
        $cpmf = 0.05;

        if (($this->Saldo + $this->Limite) >= $quantia) {

            // executa metodo da classe-pai.
            parent::Retirar($quantia);

            // debita o imposto
            parent::Retirar($quantia * $cpmf);
        } else {
            echo "Retirada não permitida... \n";
            return FALSE;
        }
        // retirada permitida
        return TRUE;
    }
    
    final function Transferir($Conta, $Valor) {
        if ($this->Retirar($Valor)){
            $Conta->Depositar($Valor);
        }
        if ($this->Titular != $Conta->Titular){
            $this->Retirar($this->TaxaTransferencia);
        }
    }

}