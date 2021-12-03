<?php
/*
 * classe tloggerxml
 * implementa o algoritmo de log em xml
 */

class TLoggerXML extends TLogger{
    /*
     * metodo write()
     * escreve uma mensagem no arquivo de log
     * @param $message = mensagem a ser escrita
     */
    
    public function write($message) {
        $time = date("Y-m-d H:i:s");
        // monta a string
        $text = "<log> \n";
        $text .= "<time>$time</time> \n";
        $text .= "<message>$message</Message> \n";
        $text .= "</log> \n";
        
        // adiciona ao final do arquivo
        $handler = fopen($this->filename, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}