<?php
# carrega as classes

include_once './Conta.class.php';
include_once './ContaCorrente.class.php';

class ContaCorrenteEspecial extends ContaCorrente{
    function Depositar($valor) {
        echo "Sobrescrevendo metodo Depositar. <br />";
        parent::Depositar($valor);
    }
    
    function Transferir($Conta, $Valor){
        echo "Sobrescrevendo metodo Transferir. <br />";
        parent::Transferir($Conta, $Valor);
    }
}