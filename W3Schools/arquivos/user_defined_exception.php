<?php

class myException extends Exception {

    function __toString() {
        return '<table border="1"><tr><td><strong>Exception ' . $this->getCode()
                . '</strong>: ' . $this->getMessage() . '<br />' . 'in'
                . $this->getFile() . ' on line ' . $this->getLine()
                . '</td></tr></table><br />';
    }

}

try {
    throw new myException(' Um erro terrivel Ocorreu! ', 42);
} catch (myException $m) {
    echo $m;
}