<?php

/*
 * classe tfilter
 * esta classe prove uma interface para definicao de filtros de selecao
 */

class TFilter extends TExpression {

    private $variable, $operator, $value;

    /*
     * metodo __contruct()
     * instancia um novo filtro
     * @param $variable = variavel
     * @param $operator = operador (>,<)
     * @param $value = valor a ser comparado
     */

    public function __construct($variable, $operator, $value) {
        // armazena as propriedades
        $this->variable = $variable;
        $this->operator = $operator;

        /*
         * transforma o valor de acordo com certas regras
         * antes de atribuir a propriedade $this->value
         */

        $this->value = $this->transform($value);
    }

    /*
     * metodo transform()
     * recebe um valor e faz as modificacoes necessarias
     * para ele ser interpretado pelo banco de dados
     * podendo ser um integer string boolean ou array
     * @param $value = valor a ser transformado
     */

    private function transform($value) {
        // caso seja um array
        if (is_array($value)) {
            // percorre os valores
            foreach ($value as $x) {
                // se for um inteiro
                if (is_integer($x)) {
                    $foo[] = $x;
                } elseif (is_string($x)) {
                    // se for string adiciona aspas
                    $foo[] = "'$x'";
                }
            }
            // converte o array em string separada pro ','
            $result = '("' . implode(',', $foo) . '")';
        }
        // caso seja uma string
        elseif (is_string($value)) {
            // adiciona aspas
            $result = "'$value'";
        }
        // caso seja valor nulo
        elseif (is_null($value)) {
            // armazena NULL
            $result = 'NULL';
        }
        // caso seja booleano
        elseif (is_bool($value)) {
            // armazena true ou false
            $result = $value ? 'TRUE' : 'FALSE';
        } else {
            $result = $value;
        }
        // retorna o valor
        return $result;
    }

    /*
     * metodo dump()
     * retorna o filtro em forma de expressao
     */

    public function dump() {
        // concatena e expressao
        return "{$this->variable} {$this->operator} {$this->value}";
    }

}