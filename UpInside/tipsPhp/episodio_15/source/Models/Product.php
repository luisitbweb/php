<?php

namespace Source\Models;

use \CoffeeCode\DataLayer\DataLayer;

/**
 * Description of Product
 *
 * @author Administrator
 */
class Product extends DataLayer
{
    public function __construct() 
    {
        parent::__construct("products", ["id", "name", "price"]);
    }
}
