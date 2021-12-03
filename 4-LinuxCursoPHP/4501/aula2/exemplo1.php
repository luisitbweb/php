<?php
class Conta{
    protected $saldo = 500.00;
    protected $titular;
    
    function Sacar($valor){
        if ($valor <= $this->saldo){
            $this->saldo -= $valor;
            echo '<p>Saque efetuado, retire o dinheiro.</p>';
        }  else {
            echo '<p>Saldo insuficiente!</p>';
        }
    }
    function Depositar($valor){
        $pre = $this->saldo;
        $deposito = $pre + $valor;
        $this->saldo = $deposito;
    }
    function verSaldo(){
        echo "<p>Seu saldo atual é: R\$ {$this->saldo}</p>";
    }
}
