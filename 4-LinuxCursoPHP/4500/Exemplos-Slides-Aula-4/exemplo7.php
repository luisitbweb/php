<?php
  
$dom = array('BR' => '.com.br','EUA' => '.com');
   
// Não concatenada
echo "O dominio é dexter{$dom['BR']}<br/>";
   
// Concatenadas
echo 'O domínio é dexter'. $dom['EUA'];