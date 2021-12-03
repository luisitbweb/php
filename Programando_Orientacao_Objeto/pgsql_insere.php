<?php
// abre conexao com postgres PG

$conn = ('host=localhost port=5432 dbname=livro user=postgres password=speak');

$query = ("INSERT INTO famosos (codigo, nome) VALUES (1, 'Mario Quintana'), "
        . "INSERT INTO famosos (codigo, nome) VALUES (2, 'john lennon'), "
        . "INSERT INTO famosos (codigo, nome) VALUES (3, 'mahatma gandhi'), "
        . "INSERT INTO famosos (codigo, nome) VALUES (4, 'ayrton senna'), "
        . "INSERT INTO famosos (codigo, nome) VALUES (5, 'charlie chaplin'), "
        . "INSERT INTO famosos (codigo, nome) VALUES (6, 'anita garibaldi'), "
        . "INSERT INTO famosos (codigo, nome) VALUES (7, 'erico verissimo')");

// insere varios registros
pg_query($conn, $query);

// fecha a conexao
pg_close($conn);