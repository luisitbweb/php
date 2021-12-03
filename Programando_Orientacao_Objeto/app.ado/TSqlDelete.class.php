<?php

/*
 * classe tsqldelete
 * esta classe prove meios para manipulacao de uma instrucao de 
 * delete no banco de dados
 */

final class TSqlDelete extends TSqlInstruction {
    /*
     * metodo getinstruction()
     * retorna a instrucao de delete em forma de string
     */

    public function getInstruction() {
        // monta a string de delete
        $this->sql = "DELETE FROM {$this->entity}";

        // retorna a clausula where do objeto $this->criteria
        if ($this->criteria) {
            $expression = $this->criteria->dump();
            if ($expression) {
                $this->sql .= ' WHERE ' . $expression;
            }
        }
        return $this->sql;
    }

}
