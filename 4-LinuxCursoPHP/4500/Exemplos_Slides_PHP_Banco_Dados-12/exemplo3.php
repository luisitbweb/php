<?php

require('exemplo1.php');

$query = mysqli_query("SELECT * FROM Usuarios");
echo '<table border="1">
         <tr><th>Nome: </th>
             <th>Senha: </th>
             <th>ID: </th></tr>';
while($lista = mysql_fetch_array($query)){
   echo "<tr><td>{$lista['Login']}</td>
             <td>{$lista['Senha']}</td>
             <td>{$lista['id_prf']}</td></tr>";
} 
echo '</table>';