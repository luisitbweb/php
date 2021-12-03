<?php

class Person {

    private $name, $age, $id;
    public $account;

    function __construct($name, $age, Account $account) {
        $this->name = $name;
        $this->age = $age;
        $this->account = $account;
    }

    function setId($id) {
        $this->id = $id;
    }

    function __destruct() {
        if (!empty($this->id)) {
            // sava Person data
            print '<br />saving person<br />';
        }
    }

    function __clone() {
        $this->id = 0;
        $this->account = clone $this->account;
    }

    function getAge() {
        return 44;
    }

    function getName() {
        return ' luis carlos ';
    }

    function __toString() {
        $desc = $this->getName();
        $desc .= "(idade {$this->getAge()})";
        return $desc;
    }

}

class Account {

    public $balance;

    function __construct($balence) {
        $this->balance = $balence;
    }

}

$ret = new Person('luis carlos', 30, new Account(150));
$ret->setId(12);
$ret1 = clone $ret;

unset($ret);

$person = new Person('luis carlos', 30, new Account(200));
$person->setId(11);
$person2 = clone $person;

// dar $person algum dinheiro
$person->account->balance += 10;

// $person2 vai o credito tambem
print $person2->account->balance;

$person1 = new Person('', '', new Account(140));
print $person1;