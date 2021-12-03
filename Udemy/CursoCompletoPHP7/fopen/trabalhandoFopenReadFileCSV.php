<?php

require_once 'config.php';

$sql = new sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

$headers = array();

foreach($usuarios[0] as $key => $value){
    array_push($headers, ucfirst($key));
}

$file = fopen("usuarios.csv", "w+");
fwrite($file, implode(",", $headers) . "\r\n");

foreach($usuarios as $row){
    $data = array();
    foreach ($row as $key => $value){
        array_push($data, $value);
    } // End foreach of Column
    fwrite($file, implode(",", $data) . "\r\n");
} // End foreach of row
fclose($file);