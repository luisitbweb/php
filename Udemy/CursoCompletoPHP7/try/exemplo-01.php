<?php

try {
    throw new Exception("Houve um erro.", 400);
} catch (Exception $ex) {
    echo json_encode(array(
       "message" => $ex->getMessage(),
        "line" => $ex->getLine(),
        "file" => $ex->getFile(),
        "code" => $ex->getCode()
    ));
}