<?php
$id_prf = $_GET['id'];
$itens = listar('Usuarios', $id_prf);

if($_POST){
	$_POST['senha'] = hash('md5',$_POST['senha']);
	if (alterar('usuarios', $_POST, $id_prf)){
		header('location: index.php');
	}	
}

?>
<section>
<form method="post" action="">
    <table border="1">
<?php
      foreach($itens as $item):?>
      <tr>
         <th>Login: </th>
         <td><input type="text" name="login" value="<?php echo $item['Login'];?>"/></td>
      </tr>
      <tr>
         <th>Senha: </th>
         <td><input type="text" name="senha" value="<?php echo $item['Senha'];?>"/></td>
      </tr>    
      <?php endforeach; ?>
      <tr>
         <td colspan="2"><input type="submit" value="Atualizar Registro"/></td>
      </table>
      </form>
   </section> 