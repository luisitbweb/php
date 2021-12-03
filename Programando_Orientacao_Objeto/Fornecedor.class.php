<?php
class Fornecedor{
    var $Codigo;
    var $RazaoSocial;
    var $Endereco;
    var $Cidade;
    var $Contato;
    
    // metodo construtor
    function __construct() {
        $this->Contato = new Contato();
    }
    
    // grava contato
    function SetContato($Nome, $Telefone, $Email){
        // delega chamada de metodo
        $this->Contato->SetContato($Nome, $Telefone, $Email);
    }
    
    // retorna contato
    function GetContato(){
        return $this->Contato->GetContato();
    }
}