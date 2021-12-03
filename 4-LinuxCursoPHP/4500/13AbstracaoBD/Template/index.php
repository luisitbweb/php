<section>
<table border="1">
<tr>
<th>ID</th>
<th>Login</th>
<th>Senha</th>
<td colspan="2"><a href="adicionar.php">Adicionar Usuário</a></td>
</tr>
   <?php
      $itens = listar('Usuarios');
      foreach($itens as $item):?>
      <tr>
            <td><?php echo $item['id_prf'];?></td>
            <td><?php echo $item['Login'];?></td>
            <td><?php echo $item['Senha'];?></td>
            <td><a href="excluir.php?id=<?php echo $item['id_prf'];?>">Excluir</a></td>
            <td><a href="editar.php?id=<?php echo $item['id_prf'];?>">Editar</a></td>
         </tr>
      <?php endforeach; ?>
      </table>
   </section> 