<?php
class Aplicacao{
    /*
     * metodo estatico
     * le o arquivo readme.txt
     */
    
    static function Sobre(){
        $fd = fopen('readme.txt', 'r');
        while ($linha = fgets($fd, 200)){
            echo '<pre>' .  $linha . '</pre>';
        }
    }
}
echo "Informações sobre a aplicação:<br>";
echo "======================:<br>";
Aplicacao::Sobre();