<?php

class Person {

    private $_name, $_age, $writer;

    function __construct(PersonWriter $writer) {
        $this->writer = $writer;
    }

    function __call($methodname, $args) {
        if (method_exists($this->writer, $methodname)) {
            return $this->writer->$methodname($this);
        }
    }

    function __set($property, $value) {
        $method = "set{$property}";
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
    }

    function setName($name) {
        $this->_name = $name;
        if (!is_null($name)) {
            $this->_name = strtoupper($this->_name);
        }
    }

    function setAge($age) {
        $this->_age = strtoupper($age);
    }

    function __unset($property) {
        $method = "set{$property}";
        if (method_exists($this, $method)) {
            $this->$method(NULL);
        }
    }

    function __get($property) {
        $method = "get{$property}";
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    function getName() {
        return 'Bob';
    }

    function getAge() {
        return 44;
    }

    function __isset($property) {
        $method = "get{$property}";
        return (method_exists($this, $method));
        if (isset($p->name)) {
            print $p->name;
        }
    }

}

class PersonWriter {

    function writeName(Person $p) {
        $this->writer->writeName($this);
    }

    function writeAge(Person $p) {
        print $p->getAge() . '<br />';
    }

}

$pw = new Person(new PersonWriter());
$pw->writeName();
