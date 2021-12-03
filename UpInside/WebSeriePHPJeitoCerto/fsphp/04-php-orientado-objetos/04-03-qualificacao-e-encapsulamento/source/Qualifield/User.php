<?php

namespace Source\Qualifield;

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
    private $firstName;
    private $lastName;
    private $email;

    private $error;

    /**
     *
     * @param type $firstName
     * @param type $lastName
     * @param type $email
     * @return boolean
     */
    public function SetUser($firstName, $lastName, $email) {

        $this->setFirstName($firstName);
        $this->setLastName($lastName);

        if(!$this->setEmail($email)){
            $this->error = "O e-mail {$this->getEmail()} não é válido!";
            return false;
        }
        return true;
    }

    /**
     *
     * @return type mixed
     */
    public function getError() {
        return $this->error;
    }

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
    private function setFirstName($firstName) {
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
    private function setLastName($lastName) {
        $this->lastName = filter_var($lastName, FILTER_SANITIZE_STRIPPED);
    }

    /**
     *
     * @return type mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Valida o e-mail do usuário em um formato válido
     * @param type $email
     * @return boolean
     */
    private function setEmail($email) {
        $this->email = $email;
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
}
