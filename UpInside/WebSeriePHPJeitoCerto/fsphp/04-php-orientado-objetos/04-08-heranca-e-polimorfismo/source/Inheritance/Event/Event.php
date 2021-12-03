<?php

namespace Source\Inheritance\Event;

/**
 * Description of Event
 *
 * @author luiscarlosss
 */
class Event {

    /**
     *
     * @var type event
     */
    private $event;
    private $date;
    private $price;
    private $register;
    protected $vacancies;

    /**
     * Event constructor.
     * @param type $event
     * @param type $date
     * @param type $price
     * @param type $vacancies
     */
    public function __construct($event, \DateTime $date, $price, $vacancies) {

        $this->event = $event;
        $this->date = $date;
        $this->price = $price;
        $this->vacancies = $vacancies;
    }

    public function register($fullName, $email) {

        if ($this->vacancies >= 1) {
            $this->vacancies -= 1;
            echo "<p class='trigger error'>Parabéns {$fullName}, vaga garantida!</p>";
        } else {
            echo "<p class='trigger error'>Desculpe {$fullName}, mas as vagas esgotaram!</p>";
        }
    }

    /**
     *
     * @param type $fullName
     * @param type $email
     */
    protected function setRegister($fullName, $email) {

        $this->register = [
            "name" => $fullName,
            "email" => $email
        ];
    }

    /**
     *
     * @return type mixed
     */
    public function getEvent() {
        return $this->event;
    }

    /**
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime {
        return $this->date->format("d/m/y H:i:s");
    }

    /**
     *
     * @return type mixed
     */
    public function getPrice() {
        return number_format($this->price, "2", ",", ".");
    }

    /**
     *
     * @return type mixed
     */
    public function getRegister() {
        return $this->register;
    }

    /**
     *
     * @return type mixed
     */
    public function getvacancies() {
        return $this->vacancies;
    }

}
