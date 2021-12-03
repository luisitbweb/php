<?php
include_once 'IConnectInfoMethod.php';

class ConSQL implements IConnectInfo{
    // passando valores usando operador de resolucao escopo
    
    private $server = IConnectInfo::HOST, $currentDB = IConnectInfo::DBNAME, $user = IConnectInfo::UNAME, $pass = IConnectInfo::PW;
    
    public function testConnection() {
        $hookup = new mysqli($this->server, $this->user, $this->pass, $this->currentDB);
        
        if (mysqli_connect_error()){
            die('não conectado');
        }
        print "Você esta conectado! <br /> {$hookup->host_info}";
        $hookup->close();
    }
}
$userConstant = new ConSQL();
$userConstant->testConnection();