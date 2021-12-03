<?php

namespace Source\Inheritance;

/**
 * Description of Address
 *
 * @author luiscarlosss
 */
class Address {

    private $street;
    private $number;
    private $complement;

    /**
     *
     * @param type $steet
     * @param type $number
     * @param type $complement
     */
    public function __construct($steet, $number, $complement = null) {

        $this->street = $steet;
        $this->number = $number;
        $this->complement = $complement;
    }

    /**
     *
     * @return type mixed
     */
    public function getStreet() {
        return $this->street;
    }

    /**
     *
     * @return type mixed
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     *
     * @return type mixed
     */
    public function getComplement() {
        return $this->complement;
    }
}
