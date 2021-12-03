<?php

abstract class Unit {

    function getComposite() {
        return NULL;
    }

    abstract function bombardStrength();

    function addUnit(Unit $unit) {
        throw new UnitException(get_class($this) . 'é uma folha');
    }

    function removeUnit(Unit $unit) {
        throw new UnitException(get_class($this) . 'é uma folha');
    }

}

class LasercannonUnit extends Unit {

    function bombardStrength() {
        return 44;
    }

    function addUnit(\Unit $unit) {
        $this->unit = $unit;
    }

    function removeUnit(\Unit $unit) {
        $this->unit = $unit;
    }

}

class Army extends Unit {

    private $units = array();

    function addUnit(Unit $unit) {
        if (in_array($unit, $this->units, TRUE)) {
            return;
        }
        $this->units[] = $unit;
    }

    function removeUnit(\Unit $unit) {
        $this->units = array_udiff($this->units, array($unit), function ($a, $b) {
            return ($a === $b) ? 0 : 1;
        }
        );
    }

    function bombardStrength() {
        $ret = 0;
        foreach ($this->units as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }

    function addArmy(Army $army) {
        array_push($this->armies, $army);
    }

}

class UnitException extends Exception {
    
}

class Archer extends Unit {

    function bombardStrength() {
        return 4;
    }

}

abstract class CompositeUnit extends Unit {

    private $units = array();

    function getComposite() {
        return $this;
    }

    protected function units() {
        return $this->units;
    }

    function removeUnit(\Unit $unit) {
        $this->units = arry_udiff($this->units, array($unit), function($a, $b) {
            return ($a === $b) ? 0 : 1;
        });
    }

    function addUnit(\Unit $unit) {
        if (in_array($unit, $this->units, TRUE)) {
            return;
        }
        $this->units[] = $unit;
    }

}

class UnitScript {

    static function joinExisting(Unit $newUnit, Unit $occupyingUnit) {
        $comp = '';
        if (!is_null($comp = $occupyingUnit->getComposite())) {
            $comp->addUnit($newUnit);
        } else {
            $comp = new Army();
            $comp->addUnit($occupyingUnit);
            $comp->addUnit($newUnit);
        }
        return $comp;
    }

}

class TroopCarrier {

    function addUnit(Unit $unit) {
        if ($unit instanceof Cavalry) {
            throw new UnitException('Não é possível obter um cavalo no veículo!');
        }
        super::addUnit($unit);
    }

    function bombarStrength() {
        return 0;
    }

}

abstract class Tile {

    abstract function getWealthFactor();
}

class Plains1 extends Tile {

    private $wealthFactor = 2;

    function getWealthFactor() {
        return $this->wealthFactor;
    }

}

abstract class TileDecorator extends Tile {

    protected $tile;

    function __construct(Tile $tile) {
        $this->tile = $tile;
    }

}

class DiamonPlains extends Plains1 {

    function getWealthFactor() {
        return parent::getWealthFactor() + 2;
    }

}

class PollutedPlains extends Plains1 {

    function getWealthFactor() {
        return parent::getWealthFactor() - 4;
    }

}

class DiamondDecorator extends TileDecorator {

    function getWealthFactor() {
        return $this->tile->getWealthFactor() + 2;
    }

}

class PollutionDecorator extends TileDecorator {

    function getWealthFactor() {
        return $this->tile->getWealthFactor() - 4;
    }

}

class RequestHelper {

    function getProductFileLines($file) {
        return file($file);
    }

    function getProductObjectFromID($id, $productname) {
        // algum tipo de pesquisa de banco de dados
        return new Product($id, $productname);
    }

    function getNameFromLine($line) {
        if (preg_match("/.*-(.*)\s\d+/", $line, $array)) {
            return str_replace('_', ' ', $array);
        }
        return '';
    }

    function getIDFromLine($line) {
        if (preg_match("/^(\d{1,3})-/", $line, $array)) {
            return $array[1];
        }
        return -1;
    }

}

class Product {

    public $id, $name;

    function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;

        $lines = getProductFileLines('param.txt');
        $objects = array();
        foreach ($lines as $line) {
            $id = getIDFromLine($line);
            $name = getNameFromLine($line);
            $objects[$id] = getProductObjectFromID($id, $name);
        }
    }

}

class ProductFacade {

    private $products = array();

    function __construct($file) {
        $this->file = $file;
        $this->compile();
    }

    private function compile() {
        $lines = getProductFileLines($this->file);
        foreach ($lines as $line) {
            $id = getIDFromLine($line);
            $name = getNameFromLine($line);
            $this->products[$id] = getProductObjectFromID($id, $name);
        }
    }

    function getProducts() {
        return $this->products;
    }

    function getProduct($id) {
        return $this->products[$id];
    }

}

abstract class ProcessRequest {

    abstract function process(RequestHelper $req);
}

class MainProcess extends ProcessRequest {

    function process(\RequestHelper $req) {
        print __CLASS__ . ': fazer algo de útil com o pedido!';
    }

}

abstract class DecorateProcess extends ProcessRequest {

    protected $processrequest;

    function __construct(ProcessRequest $pr) {
        $this->processrequest = $pr;
    }

}

class LogRequest extends DecorateProcess {

    function process(\RequestHelper $req) {
        print __CLASS__ . ': Login Obrigatorio! <br />';
        $this->processrequest->process($req);
    }

}

class AuthenticateRequest extends DecorateProcess {

    function process(\RequestHelper $req) {
        print __CLASS__ . ': Autenticação Obrigatoria! <br />';
        $this->processrequest->process($req);
    }

}

class StructureRequest extends DecorateProcess {

    function process(\RequestHelper $req) {
        print __CLASS__ . ': Pedido dados estruturado!<br />';
        $this->processrequest->process($req);
    }

}

// cria um army
$main_army = new Army();

// adiciona alguma unidades
$main_army->addUnit(new Archer());
$main_army->addUnit(new LasercannonUnit());

// cria um novo army
$sub_army = new Army();

// adiciona algumas unidades
$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());

// adiciona a segunda army para o primeiro
$main_army->addUnit($sub_army);

// todos os cálculos manipulados por trás das cenas
print "atacando com força: {$main_army->bombardStrength()}<br />";

$tile = new PollutedPlains();
print $tile->getWealthFactor();

$tile2 = new Plains1();
print $tile2->getWealthFactor(); // 2

$tile1 = new DiamondDecorator(new Plains1());
print $tile1->getWealthFactor(); // 4

$tile3 = new PollutionDecorator(new DiamondDecorator(new Plains1()));
print $tile3->getWealthFactor(); // 0

$process = new AuthenticateRequest(new StructureRequest(new LogRequest(new MainProcess())));
$process->process(new RequestHelper());

$facade = new ProductFacade('param.txt');
$facade->getProduct(234);