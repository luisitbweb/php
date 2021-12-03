<?php
/*
autoload_register(function($class)){
    
    // Define o Vendor Namespace e a pasta raiz.
    $prefix = 'Source\\';
    $baseDir = __DIR__ . '/source/';
    
    // Verifica o namespace vendor na classe
    $len = strlen($prefix);
    if(strncmp($prefix, $class, $len) !== 0){
        return;
    }
    
    // Obtem o nome da classe e substitui o namespace por diretorio
    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace("\\", '/', $relativeClass) . '.php';
    
    // Carrega o arquivo de classe se ele existir.
    if(file_exists($file)){
    require $file;
    }
}
 * 
 */