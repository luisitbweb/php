<?php
// interface Aluno
interface IAluno{
    function getNome();
    function setNome($nome);
    function setResponSavel(Pessoa $responsavel);
}

// classe aluno
class Aluno implements IAluno{
    // atribui o nome do aluno
    function setNome($nome) {
        $this->nome = $nome;
    }
    // retorna o nome do aluno
    function getNome() {
        return $this->nome;
    }
}

// instancia novo aluno
$joaninha = new Aluno();

// chama metodos quaisquer
$joaninha->setNome('Joana Maranhao');
echo $joaninha->getNome();