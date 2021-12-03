<?php

abstract class Employee {

    protected $name;
    private static $types = ['minion', 'cluedup', 'wellconnected'];

    static function recruit($name) {
        $num = rand(1, count(self::$types)) - 1;
        $class = self::$types[$num];
        return new $class($name);
    }

    function __construct($name) {
        $this->name = $name;
    }

    abstract function fire();
}

class Minion extends Employee {

    function fire() {
        print "{$this->name}: Eu vou limpar minha mesa!<br />";
    }

}

class NastyBoss {

    private $employees = array();

    function addEmployee(Employee $employeeName) {
        $this->employees[] = $employeeName;
    }

    function projectFails() {
        if (count($this->employees)) {
            $emp = array_pop($this->employees);
            $emp->fire();
        }
    }

}

class CluedUp extends Employee {

    function fire() {
        print "{$this->name}: Eu vou chamar mey advogado!<br />";
    }

}

class WellConnected extends Employee {

    function fire() {
        print "{$this->name}: Eu vou chamar meu pai!<br />";
    }

}
class ShopProduct{
    public static function getInstance($id, PDO $dbh){
        $query = 'SELECT * FROM `products` WHERE `id` = ?';
        $stmt = $dbh->prepare($query);
        if (!$stmt->execute(array($id))){
            $error = $dbh->errorInfo();
            die('Falha' . $error[1]);
        }
        $row = $stmt->fetch();
        if(empty($row)){
            return NULL;
        }elseif ($row['type'] == 'book') {
            // instancia um objeto bookproduct
        }elseif ($row['type'] == 'cd') {
            // instancia um objeto cdproduct
        }  else {
            // instancia um objeto shpproduct
        }
        $product->setId($row['id']);
        $product->setdiscount($row['discount']);
        return $product;
    }
}

$boss = new NastyBoss();
$boss->addEmployee(new Minion('harry'));
$boss->addEmployee(new CluedUp('bob'));
$boss->addEmployee(new Minion('mary'));
$boss->addEmployee(Employee::recruit('harry'));
$boss->addEmployee(Employee::recruit('bob'));
$boss->addEmployee(Employee::recruit('mary'));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();
