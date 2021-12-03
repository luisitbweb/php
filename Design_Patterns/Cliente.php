<?php
/*
 * Para alguns, essas linhas adicionais de código são irritantes, mas eu incluí-los na classe Cliente
 * para fornecer um lembrete de quão importante é o relatório de erros em aplicações de desenvolvimento
 * onde o feedback é essencial.
 * 
 * ini_set("display_errors", "1");
 * ERROR_REPORTING(E_ALL);
 * include_once('MobileSniffer.php');
 */

require_once 'MobileSniffer.php';

class Client{
    
    private $mobSniff;
        
    public function __construct() {
        $this->mobSniff = new MobileSniffer();
        
        echo 'Dispositivo = ' . $this->mobSniff->findDevice() . '<br />';
        echo 'Navegador = ' . $this->mobSniff->findBrowser() . '<br />';
    }
}
$trigger = new Client();