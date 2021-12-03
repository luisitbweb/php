<?php
namespace escola;

abstract class Alunos{
    protected  $nome, $email, $turma, $senha, $curso, $status;
    
    private    $conexao;
    
    function set($nome= 'Luis Carlos', $curso = 'PHP Orientado Objeto', $email = 'teste@4linux.com', $turma = 4501, $conexao = '', $status = false, $senha = '12345678'){
        $this->conexao = $conexao;
        $this->curso   = $curso;
        $this->email   = $email;
        $this->nome    = $nome;
        $this->senha   = $senha;
        $this->status  = $status;
        $this->turma   = $turma;
    }
    
    function get(){
        $this->conexao;
        $this->curso;
        $this->email;
        $this->nome;
        $this->senha;
        $this->status;
        $this->turma;
        
        return $this;
    }
}