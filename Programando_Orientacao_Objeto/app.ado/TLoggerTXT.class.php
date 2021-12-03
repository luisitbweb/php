<?php
/*
 * classe tloggertxt
 * implementa o algoritmo de log em txt
 */

class TLoggerTXT extends TLogger{
    /*
     * metodo write()
     * escreve uma mensagem no arquivo de log
     * @param $message = mensagem a ser escrita
     */
    
    public function write($message) {
        $time = date("Y-m-d H:i:s");
        
        // monta a string
        $text = "$time :: $message \n";
        
        // adiciona ao final do arquivo
        $handler = fopen($this->filename, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}