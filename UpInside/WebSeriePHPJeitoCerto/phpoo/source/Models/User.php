<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use PDOException;

/**
 * Description of User
 *
 * @author luiscarlosss
 */
class User extends DataLayer {

    /**
     * User constructor
     */
    public function __construct() {
        parent::__construct("users", ["first_name", "last_name", "email", "passwd"]);
    }

    /**
     *
     * @return bool
     * @throws PDOException
     */
    public function save(): bool {

        try {
            if ($this->id) {
                $user = $this->find("email = :e AND id != :i", "e={$this->email}&i={$this->id}")->count();
            } else {
                $user = $this->find("email = :e", "e={$this->email}")->count();
            }

            if ($user) {
                throw new PDOException("O e-mail que você tentou cadastrar já existe!");
            }

            return parent::save();
        } catch (Exception $exception) {
            $this->fail() = $exception;
            return false;
        }
    }
}