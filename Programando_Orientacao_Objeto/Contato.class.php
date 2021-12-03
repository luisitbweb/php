<?php
class Contato{
    var $Nome;
    var $Telefone;
    var $Email;
    
    // grava informacoes de contato
    function SetContato($Nome, $Telefone, $Email){
        $this->Nome = $Nome;
        $this->Telefone = $Telefone;
        $this->Email = $Email;
    }
    
    // obtem informacoes de contato
    function GetContato(){
        return "Nome: {$this->Nome}, Telefone: {$this->Telefone}, Email: {$this->Email}";
    }
}