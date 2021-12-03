<?php

$id = (isset($_GET['id'])) ? $_GET['id'] : 3;

if(!is_numeric($id) || strlen($id) > 4){
    exit('Pegamos Você');
}

$conn = mysqli_connect("localhost", 'luisitb', '$tr@wb3rry', 'udemyphp7');

$sql = "SELECT * FROM tb_usuarios WHERE idusuario = $id";

$exec = mysqli_query($conn, $sql);

while($resultado = mysqli_fetch_object($exec)){
    echo $resultado->deslogin . '<br />';
}