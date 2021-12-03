<?php

namespace Source\Inheritance\Event;

/**
 * Description of EventLive
 *
 * @author luiscarlosss
 */
class EventLive extends Event {

    /**
     *
     * @var type Address
     */
    private $address;

    public function __construct($event, \DateTime $date, $price, $vacancies, $address) {
        parent::__construct($event, $date, $price, $vacancies);
        $this->address = $address;
    }

    public function getAddress(): Address {

        return $this->address;
    }
}
