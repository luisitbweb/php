<?php

require_once 'Settings.php';

abstract class CommsManager {

    const APPT = 1;
    const TTD = 2;
    const CONTACT = 3;

    abstract function make($flag_int);

    abstract function getHeaderText();

    abstract function getApptEncoder();

    abstract function getTtdEncoder();

    abstract function getContactEncoder();

    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager {

    function make($flag_int) {
        switch ($flag_int) {
            case self::APPT:
                return new BloggsAppEncoder();
            case self::CONTACT:
                return new BloggsContacEncoder();
            case self::TTD:
                return new BloggsTtdEncoder();
        }
    }

    function getHeaderText() {
        return 'BloggsCal Cabeçario!<br />';
    }

    function getApptEncoder() {
        return new BloggsAppEncoder();
    }

    function getTtdEncoder() {
        return new BloggsTtdEncoder();
    }

    function getContactEncoder() {
        return new BloggsContactEncoder();
    }

    function getFooterText() {
        return 'BloggsCal rodape!<br />';
    }

}

class Sea {

    private $navigability = 0;

    function __construct($navigability) {
        $this->navigability = $navigability;
    }

}

class EarthSea extends Sea {
    
}

class MarsSea extends Sea {
    
}

class Plains {
    
}

class EarthPlains extends Plains {
    
}

class MarsPlains extends Plains {
    
}

class Forest {
    
}

class EarthForest extends Forest {
    
}

class MarsForest extends Forest {
    
}

class TerrainFactory {

    private $sea;
    private $forest;
    private $plains;

    function __construct(sea $sea, Plains $plains, Forest $forest) {
        $this->sea = $sea;
        $this->plains = $plains;
        $this->forest = $forest;
    }

    function getSea() {
        return clone $this->sea;
    }

    function getPlains() {
        return clone $this->plains;
    }

    function getForest() {
        return clone $this->forest;
    }

}

class Contained {
    
}

class Container {

    public $contained;

    function __construct() {
        $this->contained = new Contained();
    }

    function __clone() {
        // Certifique-se de que possui um objeto clonado
        // Clone de self :: $contained e não
        // Uma referência a ele
        $this->contained = clone $this->contained;
    }

}

class AppConfig {

    private static $instance;
    private $commsManager;

    private function __construct() {
        // vai executar somente uma vez
        $this->init();
    }

    private function init() {
        switch (Settings::$COMMSTYPE) {
            case 'Mega':
                $this->commsManager = new MegaCommsManager();
                break;
            default :
                $this->commsManager = new BloggsCommsManager();
        }
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getCommsManager() {
        return $this->commsManager;
    }

}

$factory = new TerrainFactory(new EarthSea(-1), new EarthPlains(), new EarthForest());
print_r($factory->getSea());
print_r($factory->getPlains());
print_r($factory->getForest());

$commsMgr = AppConfig::getInstance()->getCommsManager();
$commsMgr->getApptEncoder()->encode();
