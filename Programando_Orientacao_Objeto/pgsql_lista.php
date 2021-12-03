<?php
// abre conexao com postgres
$conn = ('host=localhost port=5432 dbname=livro user=postgres password=speak');

// define consulta que sera realizada
$query = 'SELECT `codigo`, `nome` FROM `famosos`';

// envia consulta ao banco de dados
$result = pg_query($conn, $query);

if($result){
    while ($row = pg_fetch_assoc($result)){
        echo $row['codigo'] . ' - ' . $row['nome'] . '<br />';
    }
}
// fecha a conexao
pg_close($conn);