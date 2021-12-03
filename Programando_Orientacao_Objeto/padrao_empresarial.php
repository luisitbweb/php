<?php

class Registry {

    private static $instance;
    private $values = array();

    private function __construct() {
        
    }

    static function instance() {
        if (self::$testmode) {
            return new MockRegistry();
        } elseif (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function get($key) {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }
        return NULL;
    }

    function set($key, $value) {
        $this->values[$key] = $value;
    }

    function treeBuilder() {
        if (!isset($this->treeBuilder)) {
            $this->treeBuilder = new TreeBuilder($this->conf()->get('treedir'));
        }
        return $this->treeBuilder;
    }

    function conf() {
        if (!isset($this->conf)) {
            $this->conf = new Conf();
        }
        return $this->conf;
    }

    static function testMode($mode = TRUE) {
        self::$instance = NULL;
        self::$testmode = $mode;
    }

}

class Request {
    
}

$reg = Registry::instance();
$reg->set(1, 'Muito Bom', new Request());
print_r($reg->get(1));
