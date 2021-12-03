<?php
/*
 * classe TConnection
 * gerencia conexoes com bancos de dados atraves
 * de arquivos de configuracao
 */

final class TConnection{
    /*
     * metodo __construct()
     * nao existirao instancias de tconnection por isto estmos
     * marcando-o como private
     */
    
    private function __construct() {    }
    
    /*
     * metodo open()
     * recebe o nome do banco de dados e instancia o objeto
     * PDO correspondente
     */
    
    public static function open($name){
        // verifica se existe arquivo de configuracao para este banco de dados
        if (file_exists("app.config/{$name}.ini")){
            // le o INI e retorna um array
            $db = parse_ini_file("app.config/{$name}.ini");
        }  else {
            // se nao existir, lanca um erro
            throw new Exception("Arquivo '$name' não encontrado!");
        }
        
        // le as informacoes contidas no arquivo
        $user = $db['user'];
        $pass = $db['pass'];
        $name = $db['name'];
        $host = $db['host'];
        $type = $db['type'];
        
        // descobre qual o tipo driver de banco de dados a ser utilizado
        switch ($type){
            case 'pgsql':
                $conn = new PDO("pgsql:dbname={$name}; user={$user}; password={$pass}; host=$host");
                break;
            case 'mysql':
                $conn = new PDO("mysql:host={$host}; port=3307; dbname={$name}", $user, $pass);
                break;
            case 'sqlite':
                $conn = new PDO("sqlite:{$name}");
                break;
            case 'ibase':
                $conn = new PDO("firebird:dbname={$name}", $user, $pass);
                break;
            case 'oci8':
                $conn = new PDO("oci:dbname={$name}", $user, $pass);
                break;
            case 'mssql':
                $conn = new PDO("mssql:host={$host},1433; dbname={$name}", $user, $pass);
                break;
        }
        // define para que o PDO lance excecoes na ocorrencia de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // retorna o objeto instanciado
        return $conn;
    }
}