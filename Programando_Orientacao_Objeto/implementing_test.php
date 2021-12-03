<?php

class Registry {

    protected $key = '', $value;

    protected function get($key) {
        $this->get($key);
    }

    protected function set($key, $value) {
        $this->value[$key] = $value;
    }

}

class RequestRegistry extends Registry {

    private function instance() {
        
    }

    protected function get($key) {
        $this->get($key);
    }

    protected function set($key, $value) {
        $this->value[$key] = $value;
    }

    public function getAaa() {
        return self::instance()->get('Aaa');
    }

    public function setAaa() {
        self::instance()->set('Aaa', $aaa = '');
    }

}

class SessionRegistry extends Registry {

    private function instance() {
        
    }

    protected function get($key) {
        $this->get($ke);
    }

    protected function set($key, $value) {
        
    }

    public function getBbb() {
        $this->getBbb();
    }

    public function setBbb($bbb) {
        $this->Bbb = $bbb;
    }

}

class ApplicationRegistry extends Registry {

    private function instance() {
        
    }

    protected function get($key) {
        $this->get($key);
    }

    protected function set($key, $value) {
        $this->value[$key] = $value;
    }

    public function getCcc() {
        $this->getCcc();
    }

    public function setCcc($ccc) {
        $this->key = $ccc;
    }

}
