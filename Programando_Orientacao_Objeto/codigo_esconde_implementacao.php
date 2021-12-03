<?php

include_once 'class.php';

class RegistrationMgr {

    function register(Lesson $lesson) {
        // fazer algo com esta lição
        // agora dizer a alguem

        $notifier = Notifier::getNotifier();
        $notifier->inform("nova lição: custo ({$lesson->cost()})");
    }

}

abstract class Notifier {

    static function getNotifier() {
        // adquirir concreto de acordo com a classe ou outra configuração lógica

        if (rand(1, 2) == 1) {
            return new MailNotifier();
        } else {
            return new TextNotifier();
        }
    }

    abstract function inform($message);
}

class MilNotifier extends Notifier {

    function inform($message) {
        print "Notificação de email: {$message}<br />";
    }

}

class Textnotifier extends Notifier {

    function inform($message) {
        print "Texto notificação: {$message}<br />";
    }

}

$lessons1 = new Seminar(4, new TimedCostStrategy());
$lessons2 = new Lecture(4, new FixedCoststrategy());
$mgr = new RegistrationMgr();
$mgr->register($lessons1);
$mgr->register($lessons2);
