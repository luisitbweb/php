<?php
class Cachorro{
    private $Nascimento;
    
    // metodo construtor
    function __construct($nome) {
        $this->nome = $nome;
    }
    
    // intercepta atribuicao
    function __set($propriedade, $valor) {
        if ($propriedade == 'Nascimento'){
            
            // verifica se valor e dividio 
            // 3 partes separadas por '/'
            
            if(count(explode('/', $valor)) == 3){
                echo "<p>Dado '$valor',  atribuido a  '$propriedade' </p>";
                $this->$propriedade = $valor;
            }  else {
                echo "<p>Dado '$valor',  não  atribuido a  '$propriedade' </p>";
            }
        }  else {
            $this->$propriedade = $valor;
        }
    }
}
