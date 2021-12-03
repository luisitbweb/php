<?php

/*
  function readParams($source) {
  $prams = array();
  if (preg_match("/\.xml$/1", $source)) {
  // le o texto parametro de $sourceFile
  } else {
  // le texto parametro de $source
  }
  return $prams;
  }

  function wirteParams($params, $source) {
  if (preg_match("/\.xml$/1", $source)) {
  // escreve o texto parametro para $source
  } else {
  //escreve o texto parametro para $source
  }
  }

  $file = 'param.txt';
  $array['key1'] = 'val1';
  $array['key2'] = 'val2';
  $array['key3'] = 'val3';
  wirteParams($array, $file); // array wirtten to file
  $output = readParams($file); // array read from file
  print_r($output);
 */

abstract class ParamHandler {

    protected $source, $params = array();

    function __construct($source) {
        $this->source = $source;
    }

    function addParam($key, $val) {
        $this->prams[$key] = $val;
    }

    function getAllParams() {
        return $this->params;
    }

    static function getInstance($filename) {
        if (preg_match("/\.xml$/1", $filename)) {
            return new XmlParamHandler($filename);
        }
        return new TextParamhandler($filename);
    }

    abstract function write();

    abstract function read();
}

class XmlParamHandler extends ParamHandler {

    function write() {
// write XML
// using $this->params
    }

    function read() {
// read XML
// and populate $this->prams
    }

}

class TextParamHandler extends ParamHandler {

    function write() {
// write text
// using $this->params
    }

    function read() {
// read text
// and populate $this->prams
    }

}

$test = ParamHandler::getInstance("./params.xml");
$test->addParam("key1", "val1");
$test->addParam("key2", "val2");
$test->addParam("key3", "val3");
$test->write(); // writing in XML format

$test = ParamHandler::getInstance( "./params.txt" );
$test->read(); // reading in text format

function getSummaryLine(){
    $base = "$this->title({$this->producerMainName}, ";
    $base .= "{$this->producerFirstName})";
    if ($this->type == 'book'){
        $base .= ": page count - {$this->numPages}";
    }elseif ($this->type == 'cd') {
        $base .= ": playing time - {$this->playLength}";
    }
    return $base;
}

function workWithProducts(ShopProduct $prod){
    if($prod instanceof CdProduct){
        // do cd thing
    }elseif ($prod instanceof BookProduct) {
        // do book thing
    }
}