<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author luis_
 */
class Login implements Observable {

    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    private $status = array();
    private $observers;

    function __construct() {
        $this->observers = array();
    }

    function attach(\Observable $observer) {
        $this->observers[] = $observer;
    }

    function detach(\Observable $observer) {
        $newobservers = array();
        foreach ($this->observers as $obs) {
            if ($obs !== $observer) {
                $newobservers[] = $obs;
            }
        }
        $this->observers = $newobservers;
    }

    function notify() {
        foreach ($this->observers as $obs) {
            $obs->update($this);
        }
    }

    function handleLogin($user, $pass, $ip) {
        switch (rand(1, 3)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $ret = TRUE;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $ret = FALSE;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $ret = FALSE;
                break;
        }
        Logger::logIP($user, $ip, $this->getStatus());
        if (!$ret) {
            Notifier::mailWarning($user, $ip, $this->getStatus());
        }
        $this->notify();
        return $ret;
    }

    private function setStatus($status, $user, $ip) {
        $this->status = [$status, $user, $ip];
    }

    function getStatus() {
        return $this->status;
    }

}

interface Observable {

    function attach(Observable $observer);

    function detach(Observable $observer);

    function notify();
}

interface Observer {

    function update(Observable $observable);
}

class SecurityMonitor implements Observer {

    function update(Observable $observable) {
        $status = $observable->getStatus();
        if ($status[0] == Login::LOGIN_WRONG_PASS) {
            // envia um email para sysadmin
            print __CLASS__ . ': Enviando email para sysadmin!<br />';
        }
        $status = $login->getStatus();
        if ($status[0] == Login::LOGIN_WRONG_PASS) {
            // envia email para sysadmin
            print __CLASS__ . 'envia email para sysadmin<br />';
        }
    }

}

abstract class LoginObserver implements Observer {

    private $login;

    function __construct(Login $login) {
        $this->login = $login;
        $login->attach($this);
    }

    function update(\Observable $observable) {
        if ($observable === $this->login) {
            $this->doUpdate($observable);
        }
    }

    abstract function doUpdate(Login $login);
}

class GeneralLogger extends LoginObserver {

    function doUpdate(\Login $login) {
        $status = $login->getStatus();
        // adiciona log dados para login
        print __CLASS__ . 'tadd log dados para login<br />';
    }

}

class PartnershipTool extends LoginObserver {

    function doUpdate(\Login $login) {
        $status = $login->getStatus();
        // verifica endereço ip definido cookie se ele corresponde a lista
        print __CLASS__ . 'tset Cookie se ip corresponde a lista<br />';
    }

}

abstract class Command {

    abstract function execute(CommandContext $context);
}

class LoginCommand extends Command {

    function execute(\CommandContext $context) {
        $manager = Registry::getAccessManager();
        $user = $context->get('usernama');
        $pass = $context->get('pass');
        $user_obj = $manager->login($user, $pass);
        if (is_null($user_obj)) {
            return FALSE;
        }
        $context->addParam('user', $user_obj);
        return TRUE;
    }

}

class CommandContext {

    private $params = array(), $error = '';

    function __construct() {
        $this->params = $_REQUEST;
    }

    function addParam($key, $val) {
        $this->params[$key] = $val;
    }

    function get($key) {
        return $this->params[$key];
    }

    function setError($error) {
        $this->error = $error;
    }

    function getError() {
        return $this->error;
    }

}

class CommandNotFoundException extends Expression {
    
}

class CommandFactory {

    private static $dir = 'commands';

    static function getCommand($action = 'dafault') {
        if (preg_match('/\w/', $action)) {
            throw new Exception('caracteres ilegais em ação');
        }
        $class = ucfirst(strtolower($action)) . 'Command';
        $file = self::$dir . DIRECTORY_SEPARATOR . "{$class}.php";
        if (!file_exists($file)) {
            throw new CommandNotFoundException("não consegui encontrar $file");
        }
        require_once "$file";
        if (!class_exists($class)) {
            throw new CommandNotFoundException("não $class classe localizada");
        }
        $cmd = new $class();
        return $cmd;
    }

}

class FeedbackCommand extends Command {

    function execute(\CommandContext $context) {
        $msgSystem = Registry::getMessageSystem();
        $email = $context->get('email');
        $msg = $context->get('msg');
        $topic = $context->get('topic');
        $result = $msgSystem->send($email, $msg, $topic);
        if (!$result) {
            $context->setError($msgSystem->getError());
            return FALSE;
        }
        return TRUE;
    }

}

$login = new Login();
new SecurityMonitor($login);
new GeneralLogger($login);
new PartnershipTool($login);
