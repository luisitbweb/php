<?php

//namespace classes;

/**
 * Description of User
 *
 * @author luiscarlosss
 */
class User {

    /**
     *
     * @var type atributos
     */
    public $firstName;
    public $lastName;
    public $email;

    /**
     *
     * @return type mixed
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     *
     * @param type $firstName
     */
    public function setFirstName($firstName) {
        $this->firstName = filter_var($firstName, FILTER_SANITIZE_STRIPPED);
    }

    /**
     *
     * @return type mixed
     */
    public function getLastName() {
        return $this->getLastName;
    }

    /**
     *
     * @param type $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = filter_var($lastName, FILTER_SANITIZE_STRIPPED);
    }

    /**
     *
     * @return type mixed
     */
    public function getEmail() {
        return $this->getEmail;
    }

    /**
     * Valida o e-mail do usuário em um formato válido
     * @param type $email
     * @return boolean
     */
    public function setEmail($email) {
        $this->email = $email;
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
}
