<?php

/*
 * classe tsqlinsert
 * esta classe prove meios para manipulacao de uma instrucao de insert no banco de dados
 */

final class TSqlInsert extends TSqlInstruction {
    /*
     * metodo setrowdata()
     * atribui valores a determinadas colunas no banco de dados que serao inseridas
     * @param $column = coluna da tabela
     * @param $value = valor a ser armazenado
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
     * metodo setcriteria()
     * nao existe no contexto desta classe logo ira lancar um erro ser for executado
     */

    public function setCriteria($criteria) {
        // lanca o erro
        throw new Exception("Não pode chamar setCriteria de " . __CLASS__);
    }

    /*
     * metodo getinstruction()
     * retorna a inscricao de insert em forma de string
     */

    public function getInstruction() {
        $this->sql = "INSERT INTO {$this->entity}(";
        // monta uma string contendo os nomes de colunas
        $columns = implode(', ', array_keys($this->columnValues));
        // monta uma string contendo os valores
        $values = implode(', ', array_values($this->columnValues));
        $this->sql .= $columns . ')';
        $this->sql .= " values ({$values})";

        return $this->sql;
    }

}
