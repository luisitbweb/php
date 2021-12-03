<?php

require('exemplo6.php');

$query = pg_query("SELECT * FROM Usuarios");
$lista = pg_fetch_all($query);

echo '<table border="1">
         <tr><th>Nome: </th>
             <th>Senha: </th>
             <th>ID: </th></tr>';
foreach($lista as $item){
	echo "<tr><td>{$item['login']}</td>
              <td>{$item['senha']}</td>
	          <td>{$item['id_prf']}</td></tr>";
} 
echo '</table>';