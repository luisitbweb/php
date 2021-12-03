<?php
 // $x = null;
 $x = 1500;
try{
    if(is_null($x)){
        throw new Exception('Valor não nulo.');
    }
    if ($x < 1000){
        throw new Exception('Valor não pode ser inferior a 1000.');
    }
    echo 'Valor passado validado!';
} catch (Exception $e) {
    echo 'Validação falho. ' . $e->getMessage();
}