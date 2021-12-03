<?php

class Conta {

    var $Agencia;
    var $Codigo;
    var $DataDeCriacao;
    var $Titular;
    var $Senha;
    var $Saldo;
    var $Cancelada;

    /*
     * metodo retirar
     * diminui o saldo em $quantia
     */

    function Retirar($quantia) {
        if ($quantia > 0) {
            $this->Saldo -= $quantia;
        }
    }

    /*
     * metodo depositar
     * aumenta o saldo em $quantia
     */

    function Depositar($quantia) {
        if ($quantia > 0) {
            $this->Saldo += $quantia;
        }
    }

    /*
     * metodo obtersaldo
     * retorna o saldo atual
     */

    function ObterSaldo() {
        return $this->Saldo;
    }

    /*
     * metodo construtor
     * inicializa propriedades
     */

    function __construct($Agencia, $Codigo, $DataDeCriacao, $Titular, $Senha, $Saldo) {

        $this->Agencia = $Agencia;
        $this->Codigo = $Codigo;
        $this->DataDeCriacao = $DataDeCriacao;
        $this->Titular = $Titular;
        $this->Senha = $Senha;

        // chamada a outro metodo da classe

        $this->Depositar($Saldo);
        $this->Cancelada = FALSE;
    }

    /*
     * metodo destrutor
     * finaliza objeto
     */

    function __destruct() {
        echo "Objeto Conta {$this->Codigo} de {$this->Titular->Nome} finalizado... <br />";
    }

}