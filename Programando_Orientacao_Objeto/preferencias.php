<?php

class preferences {

    private $props = array();
    private static $instance;

    private function __construct() {
        
    }

    public function setProperty($key, $val) {
        $this->props[$key] = $val;
    }

    public function getProperty($key) {
        return $this->props[$key];
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new preferences();
        }
        return self::$instance;
    }

}

abstract class AppEncoder {

    abstract function encode();
}

class BloggsAppEncoder extends AppEncoder {

    function encode() {
        return 'Nomeação de dados codificados em formato BloggsCal!<br />';
    }

}

class MegaAppEncoder extends AppEncoder {

    function encode() {
        return 'nomeação de dados codificados em formato MegaCal';
    }

}

class CommsManager {

    const BLOGGS = 1;
    const MEGA = 2;

    private $mode = 1;

    function __construct($mode) {
        $this->mode = $mode;
    }

    function getAppEncoder() {
        switch ($this->mode) {
            case (self::MEGA):
                return new MegaAppEncoder();
            default :
                return new BloggsAppEncoder();
        }
    }

    function getHeaderText() {
        switch ($this->mode) {
            case (self::MEGA):
                return 'Megacal cabeçarilho!<br />';
            default :
                return 'BloggsCal cabeçarilho!<br />';
        }
    }

}

class BloggsCommsManager extends CommsManager {

    function getHeaderText() {
        parent::getHeaderText();
        return 'BloggsCal Cabeçario!<br />';
    }

    function getAppEncoder() {
        parent::getAppEncoder();
        return new BloggsAppEncoder();
    }

    function getFooterText() {
        return 'BloggCal Rodape!<br />';
    }

}

$pref = preferences::getInstance();
$pref->setProperty('name', 'matt');
unset($pref); // remove a referencia
$pref1 = preferences::getInstance();
print $pref1->getProperty('name') . '<br />'; // demonstrar o valor não está perdido

$comms = new CommsManager(CommsManager::MEGA);
$apptEncoder = $comms->getAppEncoder();
print $apptEncoder->encode();
