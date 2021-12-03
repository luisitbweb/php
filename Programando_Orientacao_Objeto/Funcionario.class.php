<?php
class Funcionario{
    private $Codigo;
    public $Nome;
    private $Nascimento;
    protected $Salario;
    
    /*
     * metodo setsalario
     * atribui o parametro $salario a propriedade $salario
     */
    
    function SetSalario($Salario){
        // verifica se e numerico e positivo
        if (is_numeric($Salario) and ($Salario > 0)){
            $this->Salario = $Salario;
        }
    }
    
    /*
     * metodo getsalario
     * retorna o valor da propriedade $salario
     */
    
    function GetSalario(){
        return $this->Salario;
    }
}