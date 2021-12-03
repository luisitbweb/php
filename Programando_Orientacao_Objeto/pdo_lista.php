<?php
try {
    // instancia objeto pdo, conectando no postgresql
    $conn = new PDO('pgsql:dbname=livro;user=postgres;password=speak;host=localhost');
    
    // executa uma instrucao sql de consulta
    $result = $conn->query("SELECT codigo, nome FROM famosos");
    if($result){
        // percorre os resultados via iteracao
        foreach ($result as $row){
            // exibe os resultados
            echo $row['codigo'] . ' - ' . $row['nome'] . '<br />';
        }
    }
    // fecha a conexao
    $conn = NULL;
} catch (PDOException $e) {
    print 'ERROR!: ' . $e->getMessage() . '<br />';
    die();
}