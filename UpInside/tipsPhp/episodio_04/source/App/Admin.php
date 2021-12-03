<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Source\App;

/**
 * Description of Admin
 *
 * @author Administrator
 */
class Admin {
    public function home($data) {
        echo "<h1>Admin Home</h1>";
        var_dump($data);
    }
}
