<?php

class Exception {

    function __construct(string $message = NULL, int $code = 0) {
        if (func_num_args()) {
            $this->message = $message;
        }
        $this->code = $code;
        $this->file = __FILE__; // da clausula throw
        $this->line = __LINE__; // da clausula throw
        $this->trace = debug_backtrace();
        $this->string = StringFormat($this);
    }

    protected $message = 'unknown exception'; // mensagem de excecao
    protected $code = 0; // codigo de excecao definido pelo usuario
    protected $file; // nome de arquivo de origem da excecao
    protected $line; // linha de origem da excecao
    private $trace; // backtrace da excecao
    private $string; // interno apenas!!

    final function getMessage() {
        return $this->message;
    }

    final function getCode() {
        return $this->code;
    }

    final function getFile() {
        return $this->file;
    }

    final function getTrace() {
        return $this->trace;
    }

    final function getTraceAsString() {
        return self::TraceFormat($this);
    }

    function _toString() {
        return $this->string;
    }

    static private function StringFormat(Exception $exception) {
        //... uma funcao nao disponivel nos scripts do php
        // que retorna todas as informacoes relevantes como string
    }

    static private function TraceFormat(Exception $exception) {
        //... uma funcao nao disponivel nos scripts do php
        // que retorna todas as informacoes relevantes como string
    }

}
