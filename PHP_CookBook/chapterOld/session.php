<?php

session_start();
session_regenerate_id();

if((!isset($_SESSION['token'])) || ($_POST['token'] != $_SESSION['token'])){
    echo 'Sessão estabelecida.';
} else {
    echo 'Sessão não estabelecida.';
}