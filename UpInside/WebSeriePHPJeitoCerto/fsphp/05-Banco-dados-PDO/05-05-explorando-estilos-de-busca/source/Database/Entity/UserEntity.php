<?php

namespace Source\Database\Entity;

/**
 * Description of UserEntity
 *
 * @author luiscarlosss
 */
class UserEntity {
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $document;

    public function getFirstName(){
        return $this->first_name;
    }
}
