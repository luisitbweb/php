<?php
/*
 * classe pessoa
 */

class Pessoa{
    private $nome, $cidadeID; // nome da pessoa id da cidade
    
    /*
     * metodo construtor
     * instancia o objeto define alguns atributos
     * @param $nome = nome da pessoa
     * @param $cidadeID = codigo da cidade
     */
    
    function __construct($nome, $cidadeID) {
        $this->nome = $nome;
        $this->cidadeID = $cidadeID;
    }
    
    /*
     * metodo __get
     * intercepta a obtencao de propriedades
     * @param $propriedade = nome da propriedade
     */
    
    function __get($propriedade) {
        if ($propriedade == 'cidade'){
            return new cidade($this->cidadeID);
        }
    }
}

/*
 * classe cidade
 */

class Cidade{
    private $id, $nome; // nome da cidade
    
    /*
     * metodo construtor
     * instancia o objeto
     * @param $id = id da cidade
     */
    
    function __construct($id) {
        $data[1] = 'Porto Alegre';
        $data[2] = 'São Paulo';
        $data[3] = 'Rio de Janeiro';
        $data[4] = 'Belo Horizonte';
        
        // atribui o id
        $this->id = $id;
        
        // define seu nome
        $this->setNome($data[$id]);
    }
    /*
     * metodo setNome
     * define o nome da cidade
     * @param $nome = nome da cidade
     */
    
    function setNome($nome){
        $this->nome = $nome;
    }
    
    /*
     * metodo getNome
     * retorna o nome da cidade
     */
    
    function getNome(){
        return $this->nome;
    }
}
// instancia dois objetos pessoa
$maria = new Pessoa('Maria da Silva', 1);
$pedro = new Pessoa('Pedro Cardoso', 2);

// exibe o nome da cidade de cada pessoa
echo $maria->cidade->getNome() . "<br>";
echo $pedro->cidade->getNome() . "<br>";

// exibe o atributo cidade
print_r($maria->cidade);