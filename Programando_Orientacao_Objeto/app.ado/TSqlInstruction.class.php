<?php

/*
 * classe tsqlinstruction
 * esta classe prove os metodos em comum entre todas instrucoes
 * sql select insert delete e update
 */

abstract class TSqlInstruction {

    protected $sql, $criteria;

    /*
     * metodo setentity()
     * define o nome da entidade tabela manipulada pela instrucao sql
     * @param $entity = tabela
     */

    final public function setEntity($entity) {
        $this->entity = $entity;
    }

    /*
     * metodo getentity()
     * retorna o nome da entidade tabela
     */

    final public function getEntity() {
        return $this->entity;
    }

    /*
     * metodo setCriteria()
     * define um criterio de selecao dos dados atreves da composicao de um objeto
     * do tipo tcriteria que oferece uma interface para definicao ce criterios
     * @param criteria = objeto do tipo tcriteria
     */

    public function setCriteria(TCriteria $criteria) {
        $this->criteria = $criteria;
    }

    /*
     * metodo getInstruction
     * declarando como abstract obrigamos sua declaracao nas classes filhas
     * uma vez que seu comportamento sera distinto em cada uma delas configurando polimorfismo.
     */

    abstract function getInstruction();
}
