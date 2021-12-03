<?php
class Estagiario extends Funcionario{
    /*
     * metodo getsalario sobreescrito
     * retorna o salario com 12% de bonus.
     */
    
    function GetSalario() {
        return $this->Salario * 1.12;
    }
}