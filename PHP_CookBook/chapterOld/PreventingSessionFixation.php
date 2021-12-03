<?php
$inicioSessao = session_start();

echo "$inicioSessao \n\t<br />";

$novoIDSessao = session_regenerate_id();

echo "$novoIDSessao \n\t<br />";

$_SESSION['logged_in'] = TRUE;

echo '<a href="http://example.org/login.php?PHPSESSID=1234">Click Here!</a>';