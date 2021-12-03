<?php

$teste = "Oi mundo";
$closure = function() use ($teste) { echo $teste; };

$closure();