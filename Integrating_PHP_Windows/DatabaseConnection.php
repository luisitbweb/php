<?php

// connect via windows authentication without connection pooling

header('Content-Type: text/html; charset=utf-8');

$server = 'SERVERWEB\SQLEXPRESS';
$connectionInfo = ['ConnectionPooling' => FALSE,
                   'Database' => 'AdventureWorks2008R2',
                   'CharacterSet' => 'UTF-8'];
$db = sqlsrv_connect($server, $connectionInfo);
ini_set('mssql.charset', 'utf-8');

echo 'Conexão estabelecida!!!!';

 
// Table 12-3 Dangerous characters and strings used for SQL injection
// Character Meaning
// ; (semi-colon) Separates a T-SQL statement from the next statement
// ' (apostrophe) Delimits strings
// -- Indicates a comment (valid until the end of the line)
// /* and */ Delimits comments    