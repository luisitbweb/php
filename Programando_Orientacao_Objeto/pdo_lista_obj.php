<?php
try{
    // instancia objeto pdo, conectando no postgresql
    // $conn = new PDO('pgsql:dbname=livro;user=postgres;password=speak;host=localhost');
    
    $conn = new PDO('mysql:host=localhost;port=3307;dbname=livro', 'luiscarlos', 'mother');
    
    // execute uma instrucao sql de consulta
    $result = $conn->query("SELECT codigo, nome FROM famosos");
    if ($result){
        // percorre os resultados via fetch()
        while ($row = $result->fetch(PDO::FETCH_OBJ)){
            // exibe os dados na tela acessando o objeto retornado
            echo $row->codigo . ' - ' . $row->nome . '<br />';
        }
    }
    // fecha a conexao
    $conn = NULL;
} catch (PDOException $e) {
    print 'Erro!: ' . $e->getMessage() . '<br />';
    die();
}