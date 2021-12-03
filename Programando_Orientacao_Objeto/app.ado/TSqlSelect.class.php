<?php

/*
 * classe tsqlselect
 * esta classe prove meios para manipulacao de uma instrucao de select
 * no banco de dados
 */

final class TSqlSelect extends TSqlInstruction {

    private $columns;

    /*
     * metodo addcolumn
     * adiciona uma coluna a ser retornada pelo select
     * @param $column = coluna da tabela
     */

    public function addColumn($column) {
        // adiciona a coluna no array
        $this->columns[] = $column;
    }

    /*
     * metodo getinstruction()
     * retorna a instrucao de select em forma de string
     */

    public function getInstruction() {
        // monta a intrucao de select
        $this->sql = ' SELECT ';

        // monta string com os nomes de colunas
        $this->sql .= implode(', ', $this->columns);

        // adiciona na clausula from o nome da tabela
        $this->sql .= ' FROM ' . $this->entity;

        // obtem a clausula where do objeto criteria
        if ($this->criteria) {
            $expression = $this->criteria->dump();
            if ($expression) {
                $this->sql .= ' WHERE ' . $expression;
            }

            // obtem as propriedades do criterio
            $order = $this->criteria->getProperty(' order ');
            $limit = $this->criteria->getProperty(' limit ');
            $offset = $this->criteria->getProperty(' offset ');

            // obtem a ordenacao do select
            if ($order) {
                $this->sql .= ' ORDER BY ' . $order;
            } elseif ($limit) {
                $this->sql .= ' LIMIT ' . $limit;
            } elseif ($offset) {
                $this->sql .= ' OFFSET ' . $offset;
            }
        }
        return $this->sql;
    }

}
