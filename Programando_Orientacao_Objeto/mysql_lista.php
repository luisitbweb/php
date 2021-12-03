<?php
// abre conexao com o mysql
@ $conn = mysql_connect('localhost', 'luisitb', '$tr@wb3rry');

// seleciona o banco de dados ativo
@ mysql_select_db('livro', $conn);

// define a consulta que sera realizada
$query = 'SELECT `codigo`, `nome` FROM `famosos`';

// envia consulta ao banco de dados
$result = mysql_query($query, $conn);

if ($result){
    // percorre resultados da pequisa
    while ($row = mysql_fetch_assoc($result)){
        echo $row['codigo'] . ' - ' . $row['nome'] . "<br>";
    }
}
// fecha a conexao
mysql_close($conn);