<?php

class Pessoa {

    var $Codigo;
    var $Nome;
    var $Altura;
    var $Idade;
    var $Nascimento;
    var $Escolaridade;
    var $Salario;

    /*
     * metodo crescer
     * aumenta a altura em $centimetros
     */

    function Crescer($centimetros) {
        if ($centimetros > 0) {
            $this->Altura += $centimetros;
        }
    }

    /*
     * metodo Formar
     * altera a escolaridade para $titulacao
     */

    function Formar($titulacao) {
        $this->Escolaridade = $titulacao;
    }

    /*
     * metodo envelhecer
     * aumenta a idade em $anos
     */

    function Envelhecer($anos) {
        if ($anos > 0) {
            $this->Idade += $anos;
        }
    }

    /*
     * metodo construtor
     * inicializa propriedades
     */

    function __construct($Codigo, $Nome, $Altura, $Idade, $Nascimento, $Escolaridade, $Salario) {

        $this->Codigo = $Codigo;
        $this->Nome = $Nome;
        $this->Altura = $Altura;
        $this->Idade = $Idade;
        $this->Nascimento = $Nascimento;
        $this->Escolaridade = $Escolaridade;
        $this->Salario = $Salario;
    }

    /*
     * metodo destrutor
     * finaliza objeto
     */

    function __destrutor() {
        echo "Objeto {$this->Nome} finalizado... \n";
    }

}