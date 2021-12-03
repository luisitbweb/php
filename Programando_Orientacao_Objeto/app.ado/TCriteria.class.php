<?php

/*
 * classe TCriteria
 * esta classe prove uma interface utilizada para definicao de criterios
 */

class TCriteria extends TExpression {

    private $expressions, $operators, $properties;

    /*
     * metodo add()
     * adiciona um expressao ao criterio
     * @param $expression = expressao objeto TXpression
     * @param $operator = operador logico de comparacao
     */

    public function add(TExpression $expression, $operator = self::AND_OPERATOR) {
        // na primeira vez, nao precisamos de operador logico para concatenar
        if (empty($this->expressions)) {
            unset($operator);
        }
        // agrega o resultado da expressao a lista de expressoes
        $this->expressions[] = $expression;
        $this->operators[] = $operator;
    }

    /*
     * metodo dump()
     * retorna a expressao final
     */

    public function dump() {
        // concatena a lista de expressoes
        if (is_array($this->expressions)) {
            foreach ($this->expressions as $i => $expression) {
                $operator = $this->operators[$i];
                // concatena o operador com a respectiva expressao
                $result .= $operator . $expression->dump() . ' ';
            }
            $result = trim($result);
            return "({$result})";
        }
    }

    /*
     * metodo setProperty()
     * define o valor de uma propriedade
     * @param $property = propriedade
     * @param $value = valor
     */

    public function setProperty($property, $value) {
        $this->properties[$property] = $value;
    }

    /*
     * metodo getProperty()
     * retorna o valor de uma propriedade
     * @param $property = propriedade
     */

    public function getProperty($property) {
        return $this->properties[$property];
    }

}
