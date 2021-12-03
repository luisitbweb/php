<?php

class Registry {

    private static $instance;
    private $values = array();

    private function __construct() {
        
    }

    static function instance() {
        if (self::$testmode) {
            return new MockRegistry();
        } if (!isset(self::$instance)) {
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

class Request0 {
    
}

class RequestRegistry extends Registry {

    private $values = array();
    private static $instance;

    private function __construct() {
        
    }

    static function instance() {
        if (!isset(self::$instance)) {
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

    function set($key, $val) {
        $this->values[$key] = $val;
    }

    static function getRequest() {
        return self::instance()->get('request');
    }

    static function setRequest(Request $request) {
        return self::instance()->set('request', $request);
    }

}

class SessionRegistry extends Registry {

    private static $instance;

    private function __construct() {
        session_start();
    }

    static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function get($key) {
        if (isset($_SESSION[__CLASS__][$key])) {
            return $_SESSION[__CLASS__][$key];
        }
        return NULL;
    }

    function set($key, $val) {
        $_SESSION[__CLASS__][$key] = $val;
    }

    function setComplex(Complex $Complex) {
        self::instance()->set('complex', $Complex);
    }

    function getComplex() {
        return self::instance()->get('complex');
    }

}

class ApplicationRegistry extends Registry {

    private static $instance;
    private $freezedir = 'data', $values = array(), $mtimes = array();

    private function __construct() {
        
    }

    static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get($key) {
        $path = $this->freezedir . DIRECTORY_SEPARATOR . $key;
        if (file_exists($path)) {
            clearstatcache();
            $mtime = filemtime($path);
            if (!isset($this->mtimes[$key])) {
                $this->mtimes[$key] = 0;
            }
            if ($mtime > $this->mtimes[$key]) {
                $data = file_get_contents($path);
                $this->mtimes[$key] = $mtime;
                return ($this->values[$key] = unserialize($data));
            }
        }
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }
        return NULL;
    }

    protected function set($key, $val) {
        $this->values[$key] = $val;
        $path = $this->freezedir . DIRECTORY_SEPARATOR . $key;
        file_put_contents($path, serialize($val));
        $this->mtimes[$key] = time();
    }

    static function getDNS() {
        return self::instance()->get('dsn');
    }

    static function setDSN($dsn) {
        return self::instance()->set('dsn', $dsn);
    }

}

class MemApplicationRegistry extends Registry {

    private static $instance;
    private $values = array(), $id;

    const DSN = 1;

    private function __construct() {
        $this->id = @shm_attach(55, 1000, 0600);
        if (!$this->id) {
            throw new Exception('não poderia acessar a memória compartilhada');
        }
    }

    static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get($key) {
        return shm_get_var($this->id, $key);
    }

    protected function set($key, $val) {
        return shm_put_var($this->id, $key, $val);
    }

    static function getDSN() {
        return self::instance()->get(self::DSN);
    }

    static function setDSN($dsn) {
        return self::instance()->set(self::DSN, $dsn);
    }

}

class controller {

    private $applicationHelper;

    private function __construct() {
        
    }

    static function run() {
        $instance = new controller();
        $instance->init();
        $instance->handleRequest();
    }

    function init() {
        $applicationHelper = ApplicationHelper::instance();
        $applicationHelper->init();
    }

    function handleRequest() {
        $request = new Request();
        $cmd_r = new CommandResolver();
        $cmd = $cmd_r->getCommand($request);
        $cmd->execute($request);
    }

}

class ApplicationHelper {

    private static $instance;
    private $config = 'tmp/data/woo_options.xml';

    private function __construct() {
        
    }

    static function instance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function init() {
        $dsn = \ApplicationRegistry::getDNS();
        if (!is_null($dsn)) {
            return;
        }
        $this->getOptions();
    }

    private function getOptions() {
        $this->ensure(file_exists($this->config), 'Não deve procurar opções de arquivo');
        $options = simplexml_load_file($this->config);
        print get_class($options);
        $dsn = (string) $options->dsn;
        $this->ensure($dsn, 'DSN não encontrado');
        ApplicationRegistry::setDSN($dsn);
    }

    private function ensure($expr, $message) {
        if (!$expr) {
            throw new AppException($message);
        }
    }

}

class CommandResolver {

    private static $base_cmd, $default_cmd;

    function __construct() {
        if (!self::$base_cmd) {
            self::$base_cmd = new ReflectionsClass('Command');
            self::$default_cmd = new defaultCommand();
        }
    }

    function getCommand(Request $request) {
        $cmd = $request->getProperty('cmd');
        $sep = DIRECTORY_SEPARATOR;
        if (!$cmd) {
            return self::$default_cmd;
        }
        $cmd = str_replace(array('.', $sep), '', $cmd);
        $filepath = "woo{$sep}command{$sep}{$cmd}.php";
        $classname = "woo\\command\\{$cmd}";
        if (file_exists($filepath)) {
            @require_once "$filepath";
            if (class_exists($classname)) {
                $cmd_class = new ReflectionClass($classname);
                if ($cmd_class->isSubclassOf(self::$base_cmd)) {
                    return $cmd_class->newInstance();
                } else {
                    $request->addFeedback("comando $cmd não e um comando!");
                }
            }
        }
        $request->addFeedback("comando $cmd não encontrado!");
        return clone self::$default_cmd;
    }

}

abstract class Command {

    final function __construct() {
        
    }

    function execute(Request $request) {
        $this->doExecute($request);
    }

    abstract function doExecute(Request $request);
}

class Request {

    private $properties, $feedback = array();

    function __construct() {
        $this->init();
        RequestRegistry::setRequest($this);
    }

    function init() {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->properties = $_REQUEST;
            return;
        }
        foreach ($_SERVER['argv'] as $arg) {
            if (strpos($arg, '=')) {
                list($key, $val) = explode('=', $arg);
                $this->setProperty($key, $val);
            }
        }
    }

    function getProperty($key) {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }
    }

    function setProperty($key, $val) {
        $this->properties[$key] = $val;
    }

    function addFeedback($msg) {
        array_push($this->feedback, $msg);
    }

    function getFeedback() {
        return $this->feedback;
    }

    function getFeedbackString($separator = '<br />') {
        return implode($separator, $this->feedback);
    }

}

class ControllerMap {

    private $viewMap = array();
    private $forwardMap = array();
    private $classrootMap = array();

    function addClassroot($command, $classroot) {
        $this->classrootMap[$command] = $classroot;
    }

    function getClassroot($command) {
        if (isset($this->classrootMap[$command])) {
            return $this->classrootMap[$command];
        }
        return $command;
    }

    function addView($command = 'default', $status = 0, $view) {
        $this->viewMap[$command][$status] = $view;
    }

    function getView($command, $status) {
        if (isset($this->viewMap[$command][$status])) {
            return $this->viewMap[$command][$status];
        }
        return null;
    }

    function addForward($command, $status = 0, $newCommand) {
        $this->forwardMap[$command][$status] = $newCommand;
    }

    function getForward($command, $status) {
        if (isset($this->forwardMap[$command][$status])) {
            return $this->forwardMap[$command][$status];
        }
        return null;
    }

}
class AppController{
    
}