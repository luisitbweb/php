<?php
/*
 * classe tloggerhtml
 * implementa o algoritmo de log em html
 */

class TLoggerHTML extends TLogger{
    /*
     * metodo write()
     * escreve uma mensagem no arquivo de log
     * @param $message = mensagem a ser escrita
     */
    
    public function write($message) {
        $time = date("Y-m-d H:i:s");
        // monta a string
        $text  = "<p>\n";
        $text .= "<b>$time</b> : \n";
        $text .= "<i>$message</i>\n";
        $text .= "</p>\n";
        
        // adiciona ao final do arquivo
        $handler = fopen($this->filename, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}