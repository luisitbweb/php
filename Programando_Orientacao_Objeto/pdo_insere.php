<?php
try {
    // instancia objeto PDO, conectando no postgresql
    $conn = new PDO('pgsql:dbname=livro;user=postgres;password=speak;host=localhost');
    
    // executa uma serie de instrucoes sql
    $conn->exec("INSERT INTO `famosos` (`codigo`, `nome`) VALUES (1, 'erico verissimo')");
    $conn->exec("INSERT INTO `famosos` (`codigo`, `nome`) VALUES (2, 'john lennon')");
    $conn->exec("INSERT INTO `famosos` (`codigo`, `nome`) VALUES (3, 'mahatma gandhi')");
    $conn->exec("INSERT INTO `famosos` (`codigo`, `nome`) VALUES (4, 'ayrton senna')");
    $conn->exec("INSERT INTO `famosos` (`codigo`, `nome`) VALUES (5, 'charlie chaplin')");
    $conn->exec("INSERT INTO `famosos` (`codigo`, `nome`) VALUES (6, 'anita garibaldi')");
    $conn->exec("INSERT INTO `famosos` (`codigo`, `nome`) VALUES (7, 'mario quintana')");
    
    // fecha a conexao
    $conn = NULL;
} catch (PDOException $e) {
    // caso ocorra uma excecao exibe na tela
    print 'Erro!: ' . $e->getMessage() . '<br />';
    die();
}