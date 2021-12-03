<?php

require_once 'Conta.class.php';

class ContaPoupanca extends Conta {

    var $Aniversario;

    /*
     * metodo contrutor sobrescrito
     * agora tambem inicializa a variavel $aniversario
     */

    function __construct($Agencia, $Codigo, $DataDeCriacao, $Titular, $Senha, $Saldo, $Aniversario) {

    // chamada do metodo construtor da classe-pai.

        parent::__construct($Agencia, $Codigo, $DataDeCriacao, $Titular, $Senha, $Saldo);
        $this->Aniversario = $Aniversario;
    }

    /*
     * metodo retirar sobescrito
     * verificar se ha saldo para retirar tal $quantia.
     */

    function Retirar($quantia) {
        if ($this->Saldo >= $quantia) {
            // executa metodo d classe-pai
            parent::Retirar($quantia);
        } else {
            echo "Retirada não permitida... \n";
            return FALSE;
        }
        // retirada permitida
        return TRUE;
    }
    
    function Transferir($Conta, $Valor) {
        if ($this->Retirar($Valor)){
            $Conta->Depositar($Valor);
        }
    }

}