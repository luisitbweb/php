<?php
try {
    // instancia objeto pdo conectando no mysql
    $conn = new PDO('mysql:host=localhost;port=3307;dbname=livro', 'luiscarlos', 'mother');
    
    // executa um serie de instrucoes sql
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (1, 'erico verissimo')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (2, 'john lennon')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (3, 'mahatma gandhi')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (4, 'ayrton senna')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (5, 'charlie chaplin')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (6, 'anita garibaldi')");
    $conn->exec("INSERT INTO famosos (codigo, nome) VALUES (7, 'mario quintana')");
    
    // fecha a conexao
    $conn = NULL;
} catch (PDOException $e) {
    // caso ocorra uma execao exibe na tela
    print 'Erro!: ' . $e->getMessage() . '<br />';
    die();
}