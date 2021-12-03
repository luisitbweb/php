<?php

$base = array(1,2,3,4,5,6,7,8,9,10);
$par = array_filter($base, function($valor){return !($valor % 2);});

print_r($par);