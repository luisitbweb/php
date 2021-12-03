<?php

$id_prf = $_GET['id'];

if(excluir('Usuarios',$id_prf)){
	header('location: index.php');
}