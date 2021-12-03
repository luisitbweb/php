<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

declare (strict_types=1);

/*
 * Database actions (DB access, validation, etc.)
 * 
 * PHP version 7.2
 * 
 * LICENSE: This source file is subject to the MIT License, available
 * at http://www.opensource.org/licenses/mit-license.html
 * 
 * @author Luís Carlos <luis_itb@hotmail.com>
 * @copyright 2018 Ennui Design
 * @license http://www.opensource.org/licenses/mit-license.html
 * 
 */

class DB_Connect{
    /*
     * Stores a database object
     * 
     * @var object A database object
     */
    protected $db;
    
    /*
     * Checks for a DB object or create one if one isn't found
     * 
     * @param object $db A database object
     */
    protected function __construct($db=NULL) {
        if(is_object($db)){
            $this->db = $db;
        } else {
            // Constants are defined in /sys/config/db-cred.ini.php
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            try {
                $this->db = new PDO($dsn, DB_USER, DB_PASS);
            } catch (Exception $e) {
                // If the DB connection fails, output the error
                die($e->getMessage());
            }
        }
    }
}