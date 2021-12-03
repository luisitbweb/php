<?php 

if($_POST){
	if($_POST['senha'] === $_POST['senha2']){
		
		
		
		unset($_POST['senha2']);
		$_POST['senha'] = hash('md5',$_POST['senha']);
		inserir('Usuarios', $_POST);
		header('location: index.php');
	}
}

?>
<body>
   <section>
      <form method="post" action="">
      <table border="1">
         <tr>
            <th>Login</th>
            <td><input type="email" name="login" required/></td>
         </tr>
         <tr>
            <th>Senha</th>
            <td><input type="password" name="senha" required/></td>
         </tr>
         <tr>
            <th>Confirme a Senha</th>
            <td><input type="password" name="senha2" required/></td>
         </tr>
         <tr>
            <td colspan="2"><input type="submit" value="Cadastrar Regisrto"/>
         </tr>
      </table>
      </form>
   </section>
</body>       