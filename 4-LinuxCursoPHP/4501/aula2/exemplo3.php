<?php

class Conta{
    protected $saldo = 0;
    protected $titular ;
    
    function Depositar($valor){
        $this->saldo += $valor;
    }
    function Sacar($valor){
        if ($this->saldo >= $valor){
            $this->saldo -= $valor;
            echo '<p>Saque efetuado, retire o dinheiro!</p>';
        }  else {
            echo '<p>Saldo insuficiente!</p>';
        }
    }
    function verSaldo(){
        echo "<p>Seu saldo atual é: R\$ {$this->saldo}</p>";
    }
}