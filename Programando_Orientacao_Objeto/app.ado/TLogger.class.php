<?php
/*
 * classe tlogger
 * esta classe prove uma interface abstrata para definicao de algoritmos de log
 */

abstract class TLogger{
    protected $filename; // local do arquivo de log
    
    /*
     * metodo __contrutor()
     * instancia um logger
     * @param $filename = local do arquivo de log
     */
    
    public function __construct($filename) {
        $this->filename = $filename;
        
        // reseta o conteudo do arquivo
        file_put_contents($filename, '');
    }
    
    // define o metodo write como obrigatorio
    abstract function write($message);
}