<?php

/*
 * classe tsqlupdate
 * esta classe prove meios para manipulacao de uma instrucao de update no banco de dados
 */

final class TSqlUpdate extends TSqlInstruction {
    /*
     * metodo setrowdata()
     * atribui valores a determinadas colunas no banco de dados que serao modificados
     * @param $column=coluna da tabela
     * @param $value=valor a ser armazenado
     */

    public function setRowData($column, $value) {
        // monta um array indexado pelo nome da coluna
        if (is_string($value)) {
            // adiciona \ em aspas
            $value = addslashes($value);

            // caso seja uma string
            $this->columnValues[$column] = "'$value'";
        } elseif (is_bool($value)) {
            // caso seja um booolean
            $this->columnValues[$column] = $value ? 'TRUE' : 'FALSE';
        } elseif (isset($value)) {
            // caso seja outro tipo de dado
            $this->columnValues[$column] = $value;
        } else {
            // caso seja null
            $this->columnValues[$column] = 'NULL';
        }
    }

    /*
     * metodo getinstruction()
     * retorna a instrucao de update em forma de string
     */

    public function getInstruction() {
        // monstra a string de update
        $this->sql = "UPDATE {$this->entity}";
        // monta os pares coluna = valor
        if ($this->columnValues) {
            foreach ($this->columnValues as $column => $value) {
                $set[] = "{$column} = {$value}";
            }
        }
        $this->sql .= ' SET ' . implode(', ', $set);

        // retorna a clausula where do objeto $this->criteria
        if ($this->criteria) {
            $this->sql .= ' WHERE ' . $this->criteria->dump();
        }
        return $this->sql;
    }

}
