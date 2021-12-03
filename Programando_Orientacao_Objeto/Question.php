<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Question
 *
 * @author luis_
 */
abstract class Question {

    protected $prompt, $marker;

    function __construct(Marker $marker, $prompt) {
        $this->marker = $marker;
        $this->prompt = $prompt;
    }

    function mark($response) {
        return $this->marker->mark($response);
    }

}

class TextQuestion extends Question {
    // fazer o texto da pergunta coisas específicas
}

class AVQuestion extends Question {
    // fazer perguntas audiovisual coisas específicas
}

abstract class Marker {

    protected $test;

    function __construct($test) {
        $this->test = $test;
    }

    abstract function mark($response);
}

class MarkLogicMarker extends Marker {

    private $engine;

    function __construct($test) {
        parent::__construct($test);

        //$this->engine = new MarkParse($test);
    }

    function mark($response) {
        // return $this->engine->evaluate($response);
        return TRUE;
    }

}

class MatchMarker extends Marker {

    function mark($response) {
        return ($this->test == $response);
    }

}

class RegexpMarker extends Marker {

    function mark($response) {
        return (preg_match($this->test, $response));
    }

}

$markers = [new RegexpMarker("/f.ve/"), new MatchMarker('five'), new MarkLogicMarker('$input equals "five"')];
foreach ($markers as $marker) {
    print get_class($marker) . '<br />';
    $question = new TextQuestion('quantos grãos de fazer cinco', $marker);
    foreach (array('five', 'four') as $response) {
        print "\tresponse: $response:";
        if ($question->mark($response)) {
            print 'Bem feito!<br />';
        } else {
            print 'esqueça!<br />';
        }
    }
}