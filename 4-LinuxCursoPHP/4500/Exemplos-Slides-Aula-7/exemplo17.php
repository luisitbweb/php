<?php
 
$server = `uname -a`;
$closure = function() use ($server){ echo $server; };
 
$closure();