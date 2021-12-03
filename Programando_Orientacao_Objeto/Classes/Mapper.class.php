<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mapper
 *
 * @author luis_
 */
abstract class Mapper {

    protected static $PDO;

    function __construct() {
        if (!isset(self::$PDO)) {
            $dsn = \woo\base\ApplicationRegistry::getDSN();
            if (is_null($dsn)) {
                throw new \woo\base\AppException('Não tem DSN');
            }
            self::$PDO = new \PDO($dsn);
            self::$PDO->setAtrribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    function find($id) {
        $this->selectStmt()->execute(array($id));
        $array = $this->selectStmt()->fetch();
        $this->selctStmt()->closeCursor();
        if (!is_array($array)) {
            return NULL;
        }if (!isset($array['id'])) {
            return NULL;
        }
        $object = $this->createObject($array);
        return $object;
    }

    function createObject($array) {
        $obj = $this->doCreateObject($array);
        return $obj;
    }

    function insert(\woo\domain\DomainObject $obj) {
        $this->doInsert($obj);
    }

    abstract function update(\woo\domain\DomainObject $object);

    protected abstract function doCreateObject(array $array);

    protected abstract function doInsert(\woo\domain\DomainObject $object);

    protected abstract function selectStmt();
}

class VenueMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare('SELECT * FROM `venue` WHERE `id` = ?');
        $this->updateStmt = self::$PDO->prepare('UPDATE `venue` SET `name` = ?, `id` = ? WHERE `id` = ?');
        $this->insertStmt = self::$PDO->prepare('INSERT INTO `venue` (`name`) VALUES (?)');
    }

    function getCollection(array $raw) {
        return new SpaceCollection($raw, $this);
    }

    protected function doCreateObject(array $array) {
        $obj = new \woo\domain\Venue($array['id']);
        $obj->setname($array['name']);
        $space_mapper = new SpaceMapper();
        $space_collection = $space_mapper->findByVenue($array['id']);
        $obj->setSpaces($space_collection);
        return $obj;
    }

    protected function doInsert(\woo\domain\DomainObject $object) {
        print 'inserting<br />';
        debug_print_backtrace();
        $values = array($object->getName());
        $this->insertStmt->execute($values);
        $id = self::$PDO->lastInsertId();
        $object->setId($id);
    }

    function update(\woo\domain\DomainObject $object) {
        print 'updating<br />';
        $values = array($object->getName(), $object->getId());
        $this->updateStmt->execute($values);
    }

    function selectStmt() {
        return $this->selectStmt();
    }

}

abstract class Collection implements \Iterator {

    protected $mapper, $total = 0, $raw = array();
    private $result, $pointer = 0, $objects = array();

    function __construct(Mapper $mapper = NULL, array $raw = NULL) {
        if (!is_null($raw) && !is_null($mapper)) {
            $this->raw = $raw;
            $this->total = count($raw);
        }
        $this->mapper = $mapper;
    }

    function add(\woo\domain\DomainObject $object) {
        $class = $this->targetClass();
        if (!($object instanceof $class)) {
            throw new Exception("Isto e uma {$class} classes!");
        }
        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;
    }

    abstract function targetClass();

    protected function notifyAccess() {
        // deliberadamente deixado em branco!
    }

    private function getRow($num) {
        $this->notifyAccess();
        if ($num >= $this->total || $num < 0) {
            return NULL;
        }
        if (isset($this->objects[$num])) {
            return $this->objects[$num];
        }
        if (isset($this->raw[$num])) {
            $this->objects[$num] = $this->mapper->createObject($this->raw[$num]);
        }
    }

    public function rewind() {
        $this->pointer = 0;
    }

    public function current() {
        return $this->getRow($this->pointer);
    }

    public function key() {
        return $this->pointer;
    }

    public function next() {
        $row = $this->getRow($this->pointer);
        if ($row) {
            $this->pointer++;
            return $row;
        }
    }

    public function valid() {
        return (!is_null($this->current()));
    }

}

class VenueCollection extends Collection implements \woo\domain\VenueCollection {

    function targetClass() {
        return '\woo\doamin\Venue';
    }

}

interface VenueCollection1 extends Iterator {

    function add(DomainObject $venue);
}

interface SpaceCollection extends Iterator {

    function add(DomainObject $space);
}

interface EventCollection extends Iterator {

    function add(DomainObject $event);
}

$collection = \woo\domain\HelperFactory::getCollection('woo\domain\Venue');
$collection->add(new \woo\domain\Venue(NULL, 'alto e batendo'));
$collection->add(new \woo\domain\Venue(NULL, 'Eeezy'));
$collection->add(new \woo\domain\Venue(NULL, 'pato de texugo'));

foreach ($collection as $venue) {
    print $venue->getName() . '<br />';
}

class ObjectWatcher {

    private $all = array(), $dirty = array(), $new = array(), $delete = array();
    private static $instance;

    private function __construct() {
        if (!self::$instance) {
            self::$instance = new ObjectWatcher();
        }
        return self::$instance;
    }

    function globalKey(DomainObject $obj) {
        $key = get_class($obj) . '.' . $obj->getId();
        return $key;
    }

    static function add(DomainObject $obj) {
        $inst = self::instance();
        $inst->all[$inst->globalKey($obj)] = $obj;
    }

    static function exists($classname, $id) {
        $inst = self::instance();
        $key = "$classname. $id";
        if (isset($inst->all[$key])) {
            return $inst->all[$key];
        }
        return NULL;
    }

    static function addDelete(DomainObject $obj) {
        $self = self::instance();
        $self->delete[$self->globalKey($obj)] = $obj;
    }

    static function addDirty(DomainObject $obj) {
        $inst = self::instance();
        if (!in_array($obj, $inst->new, TRUE)) {
            $inst->dirty[$inst->globalKey($obj)] = $obj;
        }
    }

    static function addNew(DomainObject $obj) {
        $inst = self::instance();
        // nos ainda nao temos um id
        $inst->new[] = $obj;
    }

    static function addClean(DomainObject $obj) {
        $self = self::instance();
        unset($self->delete[$self->globalKey($obj)]);
        unset($self->dirty[$self->globalKey($obj)]);
        $self->new = array_filter($self->new, function($a) use ($obj) {
            return !($a === $obj);
        });
    }

    function performOperations() {
        foreach ($this->dirty as $key => $obj) {
            $obj->finder()->update($obj);
        }
        foreach ($this->new as $key => $obj) {
            $obj->finder()->insert($obj);
        }
        $this->dirty = array();
        $this->new = array();
    }

}

abstract class DomainObject {

    private $id = -1;

    function __construct($id = NULL) {
        if (is_null($id)) {
            $this->markNew();
        } else {
            $this->id = $id;
        }
    }

    function markNew() {
        ObjectWatcher::addNew($this);
    }

    function markDeleted() {
        ObjectWatcher::addDelete($this);
    }

    function markDirty() {
        ObjectWatcher::addDirty($this);
    }

    function markClean() {
        ObjectWatcher::addClean($this);
    }

    function setId($id) {
        $this->id = $id;
    }

    function getId() {
        $this->id;
    }

    function finder() {
        return self::getFinder(get_class($this));
    }

    static function getFinder($type) {
        return HelperFactory::getFinder($type);
    }

}

class fiel {

    protected $name = NULL, $operator = NULL, $comps = array(), $incomplete = FALSE;

    // define os campos nome(idade, para exemplo)
    function __construct($name) {
        $this->name = $name;
    }

    /*
     * adiciona o operador e o valor para o teste (>40, para exemplo e adiciona
     * para a propriedade $comps
     */

    function addTest($operator, $value) {
        $this->comps[] = array('name' => $this->name, 'operator' => $operator, 'value' => $value);
    }

    // comps e um matriz que nos podemos testar um campo em mais um maneira
    function getComps() {
        return $this->comps;
    }

    /*
     * se $comps nao contem elemeto, entao nos temos
     * comparar os dados e esses campos nao estao prontos para ser usados na pesquisa
     */

    function isIncomplete() {
        return empty($this->comps);
    }

}

class IdentityObject {

    protected $curentfiel = null, $fields = array();
    private $and = null, $enforce = array();

    // uma identificação de objeto pode iniciar vazia, ou com um campo
    function __construct($field = null, array $enforce = null) {
        if (!is_null($enforce)) {
            $this->enforce = $enforce;
        }
        if (!is_null($field)) {
            $this->fields($field);
        }
    }

    // nomes campos para este conteiner
    function getObjectFields() {
        return $this->enforce;
    }

    /*
     * lançar um novo campo
     * vamos lançar um erro se um atual campo nao esta completo
     * ao inves de idade > 40
     * esse metodo retona um referencia o atual objeto
     * permitindo a sintaxe flutuante
     */

    function field($fieldname) {
        if (!$this->isVoid() && $this->curentfiel->isIncomplete()) {
            throw new Exception('Campo incompleto!');
        }
        $this->enforceField($fieldname);
        if (isset($this->fields[$fieldname])) {
            $this->curentfiel = $this->fields[$fieldname];
        } else {
            $this->curentfiel = new fiel($fieldname);
            $this->fields[$fieldname] = $this->curentfiel;
        }
        return $this;
    }

    // o objeto identidade nao tem qualquer campo ainda
    function isVoid() {
        return empty($this->fields);
    }

    // e dado nome campo valido
    function enforceField($fieldname) {
        if (!in_array($fieldname, $this->enforce) && !empty($this->enforce)) {
            $forcelist = implode(', ', $this->enforce);
            throw new Exception("{$fieldname} não e um campo valido ($forcelist)");
        }
    }

    /*
     * adiciona um operador igualdade para o atual campo
     * idade inicia idade = 40
     * retorna uma referencia para o atual objeto via operador
     */

    function eq($value) {
        return $this->operator('=', $value);
    }

    // menor que
    function lt($value) {
        return $this->operator('<', $value);
    }

    // maior que
    function gt($value) {
        return $this->operator('>', $value);
    }

    /*
     * o trabalho do operador metodo
     * obiter o atual campo e adicionar o operador e testar valor para ele
     */

    private function operator($symbol, $value) {
        if ($this->isVoid()) {
            throw new Exception('Campo do objeto não definido');
        }
        $this->curentfiel->addTest($symbol, $value);
        return $this;
    }

    // retorna todas as comparacoes construcao para uma associacao da matriz
    function getComps() {
        $ret = array();
        foreach ($this->fields as $key => $field) {
            $ret = array_merge($ret, $field->getComps());
        }
        return $ret;
    }

}

abstract class UpdateFactory {

    abstract function newUpdate(DomainObject $obj);

    protected function buildStatement($table, array $fields, array $conditions = null) {
        $terms = array();
        if (!is_null($conditions)) {
            $query = "UPDATE{$table} SET ";
            $query .= implode(" = ?,", array_keys($fields)) . " = ?";
            $terms = array_values($fields);
            $cond = array();
            $query .= 'WHERE';
            foreach ($conditions as $key => $val) {
                $cond[] = "$key = ?";
                $terms[] = $val;
            }
            $query .= implode(' AND ', $cond);
        } else {
            $query = "INSERT INTO {$table}(";
            $query .= implode(',', array_keys($fields));
            $query .= ") VALUES (";
            foreach ($fields as $name => $value) {
                $terms[] = $value;
                $qs[] = '?';
            }
            $query .= implode(',', $qs);
            $query .= ')';
        }
        return array($query, $terms);
    }

}

class DomainObjectAssembler {

    protected static $PDO;

    function __construct(PersistenceFactory $factory) {
        $this->factory = $factory;
        if (!isset(self::$PDO)) {
            $dns = ApplicationRegistry::getDNS();
            if (is_null($dns)) {
                throw new AppException('Não tem DNS');
            }
            self::$PDO = new \PDO($dsn);
            self::$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    function getStatement($str) {
        if (!isset($this->statements[$str])) {
            $this->statements[$str] = self::$PDO->prepare($str);
        }
        return $this->statements[$str];
    }

    function findOne(IdentityObject $idobj) {
        $collection = $this->find($idobj);
        return $collection->next();
    }

    function find(IdentityObject $idobj) {
        $selfact = $this->factory->getSelectionFactory();
        list($selection, $values) = $selfact->newSelection($idobj);
        $stmt = $this->getStatement($selection);
        $stmt->execute($values);
        $raw = $stmt->fetchAll();
        return $this->factory->getCollection($raw);
    }

    function insert(DomainObject $obj) {
        $upfact = $this->factory->getUpdateFactory();
        list($update, $values) = $upfact->newUpdate($obj);
        $stmt = $this->getStatement($update);
        $stmt->execute($values);
        if ($obj->getId() < 0) {
            $obj->setId(self::$PDO->lastInsertId());
        }
        $obj->markClean();
    }

}
