<?php

class Conf {

    private $file, $xml, $lastmatch;

    function __construct($file) {
        $this->file = $file;
        if (!file_exists($file)) {
            throw new Exception('Arquivo ' . $file . ' não existe.');
        }
        $this->xml = simplexml_load_file($file, NULL, LIBXML_NOERROR);
        if (!is_object($this->xml)) {
            throw new XmlException(libxml_get_errors());
        }
        print gettype($this->xml);
        $matches = $this->xml->xpath('/conf');
        if (!count($matches)) {
            throw new ConfException('Não conseguimos encontrar elemento raiz: conf');
        }
    }

    function write() {
        if (!is_writable($this->file)) {
            throw new Exception('Arquivo ' . $this->file . 'não é gravável');
        }
        file_put_contents($this->file, $this->xml->asXML());
    }

    function get($str) {
        $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
        if (count($matches)) {
            $this->lastmatch = $matches[0];
            return (string) $matches[0];
        }
        return NULL;
    }

    function set($key, $value) {
        if (!is_null($this->get($key))) {
            $this->lastmatch[0] = $value;
            return;
        }
        $conf = $this->xml->conf;
        $this->xml->addChild('item', $value)->addAttribute('name', $key);

        try {
            $conf = new Conf(dirname(__FILE__) . '/conf01.xml');
            print 'Usuario: ' . $conf->get('user') . '<br />';
            print 'Host: ' . $conf->get('host') . '<br />';
            $conf->set('pass', 'newpass');
            $conf->write();
        } catch (Exception $ex) {
            die($ex->__toString());
        }
    }

}

class XmlException extends Exception {

    private $error;

    function __construct(LibXMLError $error) {
        $shortfile = basename($error->file);
        $msg = "[{$shortfile}, line{$error->line}, col {$error->column}] {$error->message}";
        $this->error = $error;
        parent::__construct($msg, $error->code);
    }

    function getLibXmlError() {
        return $this->error;
    }

}

class FileException extends Exception {
    
}

class ConfException extends Exception {
    
}

class Runner {

    static function init() {
        try {
            $conf = new Conf(dirname(__FILE__) . '/conf01.xml');
            print 'Usuario: ' . $conf->get('user') . '<br />';
            print 'Host: ' . $conf->get('host') . '<br />';
            $conf->set('pass', 'newpass');
            $conf->write();
        } catch (FileException $ex) {
            // permissao para problema ou não existe arquivo
        } catch (XmlException $ex) {
            // xml quebrado
        } catch (ConfException $ex) {
            // Tipo errado arquivo xml
        } catch (Exception $ex) {
            // recuo não deve ser chamado
        }
    }

}

echo <<<XML
    <?xml version="1.0">
      <conf>
            <item name="user">bob</item>
            <item name="pass">newpass</item>
            <item name="host">localhost</item>
      </conf>
XML;
