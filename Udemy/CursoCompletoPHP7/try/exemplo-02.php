<?php

function trataNome($name){
    if(!$name){
        throw new Exception("Nenhum nome foi informado.<br />", 1);
    }
    echo ucfirst($name)."<br />";
}

try {
    trataNome("Luis Carlos");
    trataNome("");
} catch (Exception $ex) {
    echo $ex->getMessage();
} finally {
    echo "Executou o Try";
}