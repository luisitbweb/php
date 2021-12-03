<?php

/*
 * classe trecord
 * esta classe prove os metodos necessarios para persistir e
 * recuperar objetos da base de dados active record
 */

abstract class TRecord {

    protected $data; // array contendo os dados do objeto

    /*
     * metodo __construtor()
     * instancia um active record se passado o $id ja carrega o objeto
     * @param [$id] = id do objeto
     */

    public function __construct($id = NULL) {
        if ($id) {
            // se o id for informado
            // carrega o objeto correspondente
            $object = $this->load($id);
            if ($object) {
                $this->fromArray($object->toArray());
            }
        }
    }

    /*
     * metodo __clone()
     * executado quando o objeto for clonado
     * limpa o id para que seja gerado um novo id para o clone
     */

    public function __clone() {
        unset($this->id);
    }

    /*
     * metodo __set()
     * executado sempre que uma propriedade for atribuida
     */

    private function __set($prop, $value) {
        // verifica se existe metodo set_<propriedade>
        if (method_exists($this, 'set_' . $prop)) {
            // executa o metodo set_<propriedade>
            call_user_func(array($this, 'set_' . $prop), $value);
        } else {
            // atribui o valor da propriedade
            $this->data[$prop] = $value;
        }
    }

    /*
     * metodo __get()
     * executado sempre que uma propriedade for requerida
     */

    private function __get($prop) {
        // verifica se existe metodo get_<propriedade>
        if (method_exists($this, 'get_' . $prop)) {
            // executa o metodo get_<propriedade>
            return call_user_func(array($this, 'get_' . $prop));
        } else {
            // retorna o valor da propriedade
            return $this->data[$prop];
        }
    }
    /*
     * metodo getEntity()
     * retorna o nome da entidade tabela
     */
    
    private function getEntity(){
        // obtem o nome da classe
        $classe = strtolower(get_class($this));
        
        // retorna o nome da classe - 'record'
        return substr($classe, 0, -6);
    }
    /*
     * metodo formarray
     * preenche os dados do objeto com um array
     */
    
    public function fromArray($data){
        $this->data = $data;
    }
    /*
     * metodo toarray
     * retorna os dados do objeto como array
     */
    
    public function toArray(){
        return $this->data;
    }
    /*
     * metodo store()
     * armazena o objeto na base de dados e retorna
     * o numero de linhas afetadas pela instrucao sql zero ou um
     */
    
    public function store(){
        // verifica se tem id ou se existe na base de dados
        if (empty($this->data['id']) or (!$this->load($this->id))){
            // incremente o id
            $this->id = $this->getLast() + 1;
            
            // cria uma instrucao de insert
            $sql = new TSqlInsert();
            $sql->setEntity($this->getEntity());
            
            // percorre os dados do objeto
            foreach ($this->data as $key => $value){
                // passa os dados do objeto para o sql
                $sql->setRowData($key, $this->$key);
            }
        }  else {
            // instancia instrucao de update
            $sql = new TSqlUpdate();
            $sql->setEntity($this->getEntity());
            
            //cria um criterio de selecao baseado no id
            $criteria = new TCriteria();
            $criteria->add(new TFilter('id', ' = ', $this->id));
            $sql->setCriteria($criteria);
            
            // percorre os dados do objeto
            foreach ($this->data as $key => $value){
                if ($key !== 'id'){
                    // o id nao precisa ir no update
                    // passa os dados do objeto para o sql
                    $sql->setRowData($key, $this->$key);
                }
            }
        } if ($conn = TTransaction::get()) { // obtem transacao ativa
            // faz o log e executa o sql
            TTransaction::log($sql->getInstruction());
            $result = $conn->exec($sql->getInstruction());
            
            // retorna o resultado
            return $result;
        }  else {
            // se nao tiver transacao retorna uma excecao
            throw new Exception('Não há transação ativa!!');
        }
    }

}
