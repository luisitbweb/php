<?php

$web = array("html","css","javascript","php");

function test_print($item, $key) {
    echo "$key. $item<br/>";
}

array_walk($web, 'test_print');
echo '<hr/>';

$string = serialize($web);
$array = unserialize($string);

var_dump($array);