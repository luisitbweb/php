<?php

$nome	= $_POST['nome'];
$email	= $_POST['email'];
$senha	= $_POST['senha'];
$senha2 = $_POST['senha2'];

if($_POST){
	foreach($_POST as $campo){
		if(empty($campo)){
			header('location: exemplo4.html');
		} 
	}
}

if($senha !== $senha2){
	echo "<p>As senhas informadas são diferentes.</p>
		  <a href='exemplo4.html'>Voltar ao formulário</a href>";
} else {
	session_start();
	$_SESSION[] = TRUE;
	setcookie('Logado', $nome);
	echo "Olá {$_COOKIE['Logado']}.";
	}

if(($_SESSION[0] === TRUE) AND ($_COOKIE['Logado'] === $nome)){
	header('Content-type: application/pdf');
	header('Content-Disposition: attachment; filename="Bazinga.pdf"');
}