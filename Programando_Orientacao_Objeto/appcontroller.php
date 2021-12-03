<?php

namespace woo\controller;

/**
 * Description of appcontroller
 *
 * @author luis_
 */
require_once 'Venue.php';
try {
    $venues = Venue::findAll();
} catch (Exception $ex) {
    include 'error.php';
    exit(0);
}

class AppController {

    private static $base_cmd;
    private static $default_cmd;
    private $controllerMap;
    private $invoked = array();

    function __construct(ControllerMap $map) {
        $this->controllerMap = $map;
        if (!self::$base_cmd) {
            self::$base_cmd = new \ReflectionClass('\\woo\\command\\Command');
            self::$default_cmd = new \woo\command\DefaultCommand();
        }
    }

    function getView(Resquest $req) {
        $view = $this->getResource($req, 'View');
        return $view;
    }

    function getForward(Request $req) {
        $forward = $this->getResource($req, 'forward');
        if ($forward) {
            $req->setProperty('cmd', $forward);
        }
        return $forward;
    }

    private function getResource(Request $req, $res) {
        // obter o comando anterior e seu estado execução
        $cmd_str = $req->getProperty('cmd');
        $previous = $req->getLastCommand();
        $status = $previous->getStatus();
        if (!$status) {
            $status = 0;
        }
        $acquire = "get$res";

        //procurar recurso para comando anterior e seu estado
        $resource = $this->controllerMap->$acquire($cmd_str, $status);

        // alternativa pesquisa anterior para estado do comando
        if (!$resource) {
            $resource = $this->controllerMap->$acquire($cmd_str, 0);
        }

        // ou comando padrao e estado comando
        if (!$resource) {
            $resource = $this->controllerMap->$acquire('default', $status);
        }

        // todos entao tem falha obter recurso para estado padrao
        if (!$resource) {
            $resource = $this->controllerMap->$acquire('default', 0);
        }
        return $resource;
    }

    function getCommand(Request $req) {
        $previous = $req->getLastCommand();
        if (!$previous) {
            // este e o primeiro comando deste pedido
            $cmd = $req->getProperty('cmd');
            if (!$cmd) {
                // propriedade cmd - não usada padrao
                $req->setProperty('cmd', 'default');
                return self::$default_cmd;
            }
        } else {
            // um comando ja foi executado neste pedido
            $cmd = $this->getForward($req);
            if (!$cmd) {
                return NULL;
            }
        }

        // nos agora temos um nome comando $cmd transforma-lo em um objeto comando
        $cmd_obj = $this->resolveCommand($cmd);
        if (!$cmd_obj) {
            throw new \woo\base\AppException('Não foi possivel resolver' . $cmd);
        }
        $cmd_class = get_class($cmd_obj);
        if (isset($this->invoked[$cmd_class])) {
            throw new \woo\base\AppException('encaminhamento circular');
        }
        $this->invoked[$cmd_class] = 1;

        // retona o comando objeto
        return $cmd_obj;
    }

    function resolveCommand($cmd) {
        $classroot = $this->controllerMap->getClassroot($cmd);
        $filepath = "woo/command/$classroot.php";
        $classname = "\\woo\\command\\{$classroot}";
        if (file_exists($classname)) {
            require_once "$filepath";
            if (class_exists($classname)) {
                $cmd_class = new \ReflectionClass($classname);
                if ($cmd_class->isSubclassOf(self::$base_cmd)) {
                    return $cmd_class->newInstance();
                }
            }
        }
        return NULL;
    }

}

abstract class Command {

    private static $STATUS_STRINGS = array('CMD_DEFAULT' => 0, 'CMD_OK' => 1, 'CMD_ERROR' => 2, 'CMD_INSUFFICIENT_DATA' => 3);
    private $status = 0;

    final function __construct() {
        
    }

    function execute(\woo\controller\Request $request) {
        $this->status = $this->doExecute($request);
        $request->setCommand($this);
    }

    function getStatus() {
        return $this->status;
    }

    static function statuses($str = 'CMD_DEFAULT') {
        if (empty($str)) {
            $str = 'CMD_DEFAULT';
        }
        // CONVERTE CARACTERES EM UM CONDIÇÃO NUMERO
        return self::$STATUS_STRINGS[$str];
    }

    abstract function doExecute(\woo\controller\Request $request);
}

class AddVenue extends Command {

    function doExecute(Request $request) {
        $name = $request->getProperty('venue_name');
        if (!$name) {
            $request->addFeedback('Nome não fornecido');
            return self::statuses('CMD_INSUFFICIENT_DATA');
        } else {
            $venue_obj = new \woo\domain\Venue(null, $name);
            $request->setObject('venue', $venue_obj);
            $request->addfeedback("$name adicionar ({$venue_obj->getid()})");
            return self::statuses('CMD_OK');
        }
    }

}

class Venue {

    private $id, $name;

    function __construct($id, $name) {
        $this->name = $name;
        $this->id = $id;
    }

    function getName() {
        return $this->name;
    }

    function getId() {
        return $this->id;
    }

}

abstract class PageController {

    private $request;

    function __construct() {
        $request = \woo\base\RequestRegistry::getRequest();
        if (is_null($request)) {
            $request = new \Request();
        }
        $this->request = $request;
    }

    abstract function process();

    function forward($resource) {
        include '$resource';
        exit(0);
    }

    function getRequest() {
        return $this->request;
    }

}

class AddVenueController extends PageController {

    function process() {
        try {
            $request = $this->getRequest();
            $name = $request->getProperty('venue_name');
            if (is_null($request->getProperty('submitted'))) {
                $request->addFeedback('Escolha um nome para o local!');
                $this->forward('add_venue.php');
            }
            // apenas cria o objeto suficiente para adicionar para a base dedados
            $venue = new \woo\domain\Venue(null, $name);
            $this->forward('ListVenues.php');
        } catch (Exception $ex) {
            $this->forward('error.php');
        }
    }

}

$controller = new AddVenueController();
$controller->process();

abstract class Base {

    static $DB, $stmts = array();

    function __construct() {
        $dsn = \woo\base\ApplicationRegistry::getDSN();
        if (is_null($dsn)) {
            throw new \woo\base\AppException('Não DSN');
        }
        self::$DB = new \PDO($dsn);
        self::$DB->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    function prepareStatement($stmt_s) {
        if (isset(self::$stmts[$stmt_s])) {
            return self::$stmts[$stmt_s];
        }
        $stmt_handle = self::$DB->prepare($stmt_s);
        self::$stmts[$stmt_s] = $stmt_handle;
        return $stmt_handle;
    }

    protected function doStatement($stmt_s, $values_a) {
        $sth = $this->prepareStatement($stmt_s);
        $sth->closeCursor();
        $db_result = $sth->execute($values_a);
        return $sth;
    }

}

class VenueManager extends Base {

    static $add_venue = 'INSERT INTO `venue`'
            . '(name) VALUES (?)';
    static $check_slot = 'SELECT `id`, `name` FROM `event` WHERE '
            . '`space` = ? AND (start + duration) > ? AND `start` < ?';
    static $add_space = 'INSERT INTO `space` '
            . '(`name`, `venue`) VALUES (?, ?)';
    static $add_event = 'INSERT INTO `` '
            . '(`name`, `space`, `start`, `duration`) VALUES (?, ?, ?, ?)';

    function addVenue($name, $space_array) {
        $ret = array();
        $ret['venue'] = array($name);
        $this->doStatement(self::$add_venue, $ret['venue']);
        $v_id = self::$DB->lastInsertId();
        $ret['spaces'] = array();
        foreach ($space_array as $space_name) {
            $values = array($space_name, $v_id);
            $this->doStatement(self::$add_space, $values);
            $s_id = self::$DB->lastInsertId();
            array_unshift($values, $s_id);
            $ret['spaces'][] = $values;
        }
        return $ret;
    }

    function bookEvent($space_id, $name, $time, $duration) {
        $values = array($space_id, $time, ($time + $duration));
        $stmt = $this->doStatement(self::$check_slot, $values, false);
        if ($result = $stmt->fetch()) {
            throw new \woo\base\AppException("duplo reservado! tente novamente");
        }
        $this->doStatement(self::$add_event, array($name, $space_id, $time, $duration));
    }

}

abstract class DomainObject {

    private $id;

    function __construct($id = null) {
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    static function getCollection($type) {
        return array();
    }

    function collection() {
        return self::getCollection(get_class($this));
    }

}

class Venue1 extends DomainObject {

    private $name, $spaces;

    function __construct($id = null, $name = null) {
        $this->name = $name;
        $this->spaces = self::getCollection('\\woo\\domain\\Space');
        parent::__construct($id);
    }

    function setSpaces(SpaceColletction $spaces) {
        $this->spaces = $spaces;
    }

    function getSpaces() {
        return $this->spaces;
    }

    function addSpace(Space $space) {
        $this->spaces->add($space);
        $space->setVenue($this);
    }

    function setName($name_s) {
        $this->name = $name_s;
        $this->markDirty();
    }

    function getName() {
        return $this->name;
    }

}
