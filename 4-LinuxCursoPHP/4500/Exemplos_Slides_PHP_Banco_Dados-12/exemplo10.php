<?php

require('exemplo6.php');

$id = '4';
$table = 'Usuarios';

pg_query("DELETE FROM $table WHERE id_prf='$id'");