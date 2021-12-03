<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * Description of User
 *
 * @author Administrator
 */
class User extends DataLayer
{
    /**
     * User constructor.
     */
    public function __construct() 
    {
        parent::__construct("users", ["first_name", "last_name", "email"]);
    }
}
