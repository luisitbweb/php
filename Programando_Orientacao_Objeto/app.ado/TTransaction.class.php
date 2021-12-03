<?php

/*
 * classe ttransaction
 * esta classe prove os metodos necessarios manipular transacoes
 */

final class TTransaction {

    private static $logger, $conn; // objeto de log, conexao ativa

    /*
     * metodo __construtor()
     * esta declarado como private para impedir que se 
     * crie instancias de ttransaction
     */

    private function __construct() {
        
    }

    /*
     * metodo open()
     * abre uma transacao e uma conexao ao BD
     * @param $database = nome do banco de dados
     */

    public static function open($database) {
        // abre uma conexao e armazena na propriedade estatica $conn
        if (empty(self::$conn)) {
            self::$conn = TConnection::open($database);
            // inicia a transacao
            self::$conn->beginTransaction();

            // desliga o log de sql
            self::$logger = NULL;
        }
    }

    /*
     * metodo get()
     * retorna a conexao ativa da transacao
     */

    public static function get() {
        // retorna a conexao ativa
        return self::$conn;
    }

    /*
     * metodo rollback()
     * desfaz todas operacoes realizadas na transacao
     */

    public static function rollback() {
        if (self::$conn) {
            // desfaz as operacoes realizadas durante a transacao
            self::rollback();
            self::$conn = NULL;
        }
    }

    /*
     * metodo close()
     * aplica todas operacoes realizadas e fecha a transacao
     */

    public static function close() {
        if (self::$conn) {
            /*
             * aplica as operacoes realizadas
             * durante a transacao
             */

            self::$conn->commit();
            self::$conn = NULL;
        }
    }

    /*
     * metodo setlogger()
     * define qual estrategia algoritmo de log sera usado
     */

    public static function setLogger(TLogger $logger) {
        self::$logger = $logger;
    }

    /*
     * metodo log()
     * armazena uma mensagem no arquivo de log
     * baseada na estrategia $Logger atual
     */

    public static function log($message) {
        // verifica existe um logger
        if (self::$logger) {
            self::$logger->write($message);
        }
    }

}
