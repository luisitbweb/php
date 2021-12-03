<?php

require('exemplo1.php');

$id = '3';
$table = 'Usuarios';

mysql_query("DELETE FROM $table WHERE id_prf='$id'");