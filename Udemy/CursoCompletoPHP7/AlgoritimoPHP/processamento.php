<?php

if(isset($_POST['rpeca']) && ($_POST['rvalor']) && ($_POST['rqtd'])){
    
    $codpeca = $_POST['rpeca'];
    $valor = $_POST['rvalor'];
    $qtd = $_POST['rqtd'];
    
    echo $codpeca, $valor, $qtd;
    
}elseif(isset($_POST['rpeca']) || ($_POST['rvalor']) || ($_POST['rqtd'])){
    echo 'Valor não definido!!! todos os valores tem que ser fornecidos.';
}else{
    echo 'erro de execução.....';
}