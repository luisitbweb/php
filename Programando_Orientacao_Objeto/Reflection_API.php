<?php

class Person {

    public $name;

    function __construct($name) {
        $this->name = $name;
    }

}

interface Module {

    function execute();
}

class FtpModule implements Module {

    function setHost($host) {
        print "FtpModule::setHost(): $host<br />";
    }

    function execute() {
        
    }

    function setUser($user) {
        print "FtpModule::setUser(): $user<br />";
    }

}

class PersonModule implements Module {

    function setPerson(Person $person) {
        print "PersonModule::setPerson(): {$person->name}<br />";
    }

    function execute() {
        
    }

}

class ModuleRunner {

    private $configData = ['PersonModule' => array('person' => 'bob'),
        'FtpModule' => array('host' => 'example.com',
            'user' => 'anon')];
    private $modules = array();

    function init() {
        $interface = new ReflectionClass('Module');
        foreach ($this->configData as $modulename => $params) {
            $module_class = new ReflectionClass($modulename);
            if (!$module_class->isSubclassOf($interface)) {
                throw new Exception("Tipo de modulo desconhecido: $modulename");
            }
            $module = $module_class->newInstance();
            foreach ($module_class->getMethods() as $method) {
                $this->handleMethod($module, $method, $params);
                // cobrimos handleMethod () em uma listagem de futuro!
            }
            array_push($this->modules, $module);
        }
    }

    function handleMethod(Module $module, ReflectionMethod $method, $params) {
        $name = $method->getName();
        $args = $method->getParameters();

        if (count($args) != 1 || substr($name, 0, 3) != 'set') {
            return FALSE;
        }
        $property = strtolower(substr($name, 3));
        if (!isset($params[$property])) {
            return FALSE;
        }
        $args_class = $args[0]->getClass();
        if (empty($args_class)) {
            $method->invoke($module, $params[$property]);
        } else {
            $method->invoke($module, $args_class->newInstance($params[$property]));
        }
    }

}

$test = new ModuleRunner();
$test->init();
