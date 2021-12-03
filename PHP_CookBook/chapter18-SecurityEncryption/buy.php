<?php

session_start();
session_regenerate_id();
$_SESSION['logged_in'] = true;

if((! isset($_SESSION['token'])) || ($_POST['token'] != $_SESSION['token'])){
    
    
} else {

    
}