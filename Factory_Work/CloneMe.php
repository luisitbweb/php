<?php
abstract class CloneMe{
    public $name, $picture;
    abstract function __clone();
}

class Person extends CloneMe{
    public function __construct() {
        $this->picture = 'imagens/background-fundo.jpg';
        $this->name = 'Original';
    }
    public function display(){
        echo "<img alt='teste' width='80' height='80' src='$this->picture'><br />";
        echo "<br /><br /> $this->name";
    }
    function __clone(){}
}

$worker = new Person();
$worker->display();

$slacker = clone $worker;
$slacker->name = 'Cloned';
$slacker->display();